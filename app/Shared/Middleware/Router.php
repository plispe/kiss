<?php

namespace App\Shared\Middleware;

/**
 * Aura router classes
 */
use Aura\Router\Matcher;

/**
 * PSR-7 interfaces
 * @see http://www.php-fig.org/psr/psr-7/
 */
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;

/**
 * Own classes and interfaces
 */
use App\Shared\Behaviour\Middleware\AuraSuccessHandlingTrait;
use App\Shared\Behaviour\Middleware\AuraFailureHandlingTrait;

/**
 * Class Router
 * @package App\Shared\Middleware
 * @author Petr Pliska <petr.pliska@post.cz>
 */
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
     * @var Matcher
     */
    protected $matcher;

    /**
     * @var Dispatcher
     */
    protected $dispatcher;

    /**
     * Router constructor.
     * @param Matcher $matcher
     */
    public function __construct(Matcher $matcher, Dispatcher $dispatcher)
    {
        $this->matcher = $matcher;
        $this->dispatcher = $dispatcher;
    }

    /**
     * @inheritdoc
     */
    public function __invoke(ServerRequestInterface $request, ResponseInterface $response, callable $next): ResponseInterface
    {
        // If no route is matcher
        if (! $route = $this->matcher->match($request)) {
            $this->handleFailure($this->matcher);
        }

        return $this->handleSuccess($route, $request->withAttribute('route', $route), $response, $next);
    }
}
