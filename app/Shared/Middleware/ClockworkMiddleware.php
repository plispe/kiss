<?php

/**
 * Clockwork middleware
 *
 * @author Petr Pliska <petr.pliska@post.cz>
 */

namespace App\Shared\Middleware;

/**
 * Clockwork main class
 * @see https://github.com/itsgoingd/clockwork
 */
use Clockwork\Clockwork;

/**
 * PSR-7 interfaces
 * @see http://www.php-fig.org/psr/psr-7/
 */
use Psr\Http\Message\{RequestInterface, ResponseInterface};

/**
 *
 */
use Zend\Diactoros\Response\JsonResponse;

/**
 * Own classes and interfaces
 */
use App\Shared\Behaviour\Common\ClockworkTrait;

class ClockworkMiddleware implements MiddlewareInterface
{
    use ClockworkTrait;

    /**
     * @inheritdoc
     */
    public function __invoke(RequestInterface $request, ResponseInterface $response, callable $next)
    {
        $this->endEvent('server');

        /**
         * If clockwork is not enabled next middleware is called
         */
        if (getenv('USE_CLOCKWORK') !== 'true') {
            return $next($request, $response, $next);
        }

        $path           = $request->getUri()->getPath();
        $isClockworkUrl = preg_match('#/__clockwork(/(?<id>[0-9\.]+))?#', $path, $matches);

        /**
         * Url which retrieve a clockwork request
         */
        if ($isClockworkUrl) {
            /**
             * Return request JSON
             */
            $jsonResponse =  new JsonResponse(
                $this->retrieveRequest($matches['id'])
            );

            return $jsonResponse;
        }

        $this->startEvent('routing', 'Matching route');
        /**
         * Call middleware chain
         */
        $response = $next($request, $response, $next);

        /**
         * Log request
         */
        $this->logRequest();

        /**
         * Set clockwork headers
         */
        $response = $response
            ->withHeader('X-Clockwork-Id', $this->clockwork->getRequest()->id)
            ->withHeader('X-Clockwork-Version', Clockwork::VERSION)
            ->withHeader('X-Clockwork-Path', 'http://api.kiss.local/__clockwork/');

        return $response;
    }
}
