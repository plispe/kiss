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
use Psr\Http\Message\{RequestInterface, ResponseInterface};

trait AuraSuccessHandlingTrait
{
    /**
     * Handle route execution, if route handler is callable, it will be executed directly.
     * Otherwise next middleware is called
     *
     * @param Route $route
     * @param RequestInterface $request
     * @param ResponseInterface $response
     * @param callable $next
     *
     * @return ResponseInterface
     */
    protected function handleSuccess(Route $route, RequestInterface $request, ResponseInterface $response, callable $next): ResponseInterface
    {
        if (is_callable($route->handler)) {
            // get handler callable
            $handler = $route->handler;
            // Start route execution event
            $this->startEvent('routeExecution', 'Execution of route code.');
            // Execute route handler
            $response = $handler($request, $response);
            // End route execution event
            $this->endEvent('routeExecution');
        } else {
            // Start dispatching event
            $this->startEvent('dispatching', 'Dispatching controller.');
            // Start dispatching route (calls next middleware which should be dispatcher)

            // Call dispatcher
            $d        = $this->dispatcher;
            $response = $d($request, $response, $next);
        }

        return $response;
    }
}
