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
use Aura\Router\Route;

/**
 * PSR-7 interfaces
 * @see http://www.php-fig.org/psr/psr-7/
 */
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\RequestInterface;

/**
 * Middleware classes and behaviours
 */
use App\Shared\Middleware\Dispatcher;
use App\Shared\Behaviour\Middleware\AuraFailureHandlingTrait;
use App\Shared\Behaviour\Common\ClockworkTrait;

class Router implements MiddlewareInterface
{
    /**
     * Handle unmatche route
     */
    use AuraFailureHandlingTrait;

    /**
     * Clockwork trait
     */
    use ClockworkTrait;

    /**
     * @Inject
     * @var Matcher
     */
    protected $matcher;

    /**
     * @Inject
     * @var Dispatcher
     */
    protected $dispatcher;

    /**
     * @inheritdoc
     */
    public function __invoke(RequestInterface $request, ResponseInterface $response, callable $next)
    {
        $route   = $this->matcher->match($request);

        if (! $route) {
            $this->handleFailure($this->matcher);
        }

        $this->endEvent('routing');
        $this->startEvent('dispatching', 'Dispatching controller');
        $response =  $next(
            $request->withAttribute('route', $route),
            $response,
            $next
        );

        return $response;
    }
}
