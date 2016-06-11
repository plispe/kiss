<?php

/**
 * Defines method for handlin success
 *
 * @author Petr Pliska <petr.pliska@post.cz>
 */

namespace App\Shared\Behaviour\Middleware;

/**
 * Aura router
 * @see http://auraphp.com/packages/Aura.Router/
 */
use Aura\Router\Route;

/**
 * PSR-7 interfaces
 * @see http://www.php-fig.org/psr/psr-7/
 */
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;

trait AuraSuccessHandlingTrait
{
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
    protected function handleSuccess(Route $route, ServerRequestInterface $request, ResponseInterface $response, callable $next): ResponseInterface
    {
        if (is_callable($route->handler)) {
            // get handler callable
            $handler = $route->handler;
            // Execute route handler
            $response = $handler($request, $response);
        } else {
            // Start dispatching route (calls next middleware which should be dispatcher)
            $d        = $this->dispatcher;
            $response = $d($request, $response, $next);
        }

        return $response;
    }
}
