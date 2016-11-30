<?php

namespace App\Shared\Middleware;

/**
 * Aura router
 * @see http://auraphp.com/packages/Aura.Router/
 */
use Aura\Router\Route;
use Aura\Router\Matcher;

/**
 * PSR-7 interfaces
 * @see http://www.php-fig.org/psr/psr-7/
 */
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;

/**
 * Symfony http exceptions
 */
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Symfony\Component\HttpKernel\Exception\NotAcceptableHttpException;
use Symfony\Component\HttpKernel\Exception\MethodNotAllowedHttpException;

/**
 * Class Router
 * @package App\Shared\Middleware
 *
 * @author Petr Pliska <petr.pliska@post.cz>
 */
class Router implements MiddlewareInterface
{
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
    public function __invoke(ServerRequestInterface $request, ResponseInterface $response, callable $next)
    {
        // If no route is matcher
        if (!$route = $this->matcher->match($request)) {
            $this->handleFailure($this->matcher);
        }

        return $this->handleSuccess($route, $request->withAttribute('route', $route), $response, $next);
    }

    /**
     * Handle route execution, if route handler is callable, it will be executed directly.
     * Otherwise next middleware is called
     *
     * @param Route $route
     * @param ServerRequestInterface $request
     * @param ResponseInterface $response
     * @param callable $next
     *
     * @return ResponseInterface
     */
    protected function handleSuccess(Route $route, ServerRequestInterface $request, ResponseInterface $response, callable $next)
    {
        if (is_callable($route->handler)) {
            // get handler callable
            $handler = $route->handler;
            // Execute route handler
            return $handler($request, $response);
        }

        // Start dispatching route (calls next middleware which should be dispatcher)
        $d = ($this->dispatcher);
        return $d($request, $response, $next);
    }

    /**
     * @param Matcher $matcher
     *
     * @throws MethodNotAllowedHttpException
     * @throws NotAcceptableHttpException
     * @throws NotFoundHttpException
     */
    protected function handleFailure(Matcher $matcher)
    {
        // get the first of the best-available non-matched routes
        $failedRoute = $matcher->getFailedRoute();

        $rule = false;
        if (isset($failedRoute->failedRule)) {
            $rule = $failedRoute->failedRule;
        }

        // which matching rule failed?
        switch ($rule) {
            case \Aura\Router\Rule\Allows::class:
                throw new MethodNotAllowedHttpException($failedRoute->allows);
            case \Aura\Router\Rule\Accepts::class:
                throw new NotAcceptableHttpException;
            default:
                throw new NotFoundHttpException;
        }
    }
}
