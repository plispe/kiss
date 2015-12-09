<?php

/**
 * Routing middleware using PSR-7 aura router
 *
 * @author Petr Pliska <petr.pliska@post.cz>
 */

namespace App\Shared\Middleware;

/**
 * Aura router classes
 */
use Aura\Router\Matcher;


/**
 * PSR-7 interfaces
 * @see http://www.php-fig.org/psr/psr-7/
 */
use Psr\Http\Message\{RequestInterface, ResponseInterface};

/**
 * Own classes and interfaces
 */
use App\Shared\{
    Middleware\Dispatcher,
    Behaviour\Common\ClockworkTrait,
    Behaviour\Middleware\AuraSuccessHandlingTrait,
    Behaviour\Middleware\AuraFailureHandlingTrait
};

class Router implements MiddlewareInterface
{
    /**
     * Handle unmatche route
     */
    use AuraFailureHandlingTrait;

    /**
     * Handle matched route
     */
    use AuraSuccessHandlingTrait;

    /**
     * Clockwork trait
     */
    use ClockworkTrait;

    /**
     * @inject
     * @var Matcher
     */
    protected $matcher;

    /**
     * @inject
     * @var Dispatcher
     */
    protected $dispatcher;

    /**
     * @inheritdoc
     */
    public function __invoke(RequestInterface $request, ResponseInterface $response, callable $next): ResponseInterface
    {
        // If no route is matcher
        if (! $route = $this->matcher->match($request)) {
            $this->handleFailure($this->matcher);
        }

        // Log events
        $this->endEvent('routing');

        return $this->handleSuccess($route, $request->withAttribute('route', $route), $response, $next);
    }
}
