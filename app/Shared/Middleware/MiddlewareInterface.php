<?php

/**
 * Interface for PSR-7 middleware class
 * @author Petr Pliska <petr.pliska@post.cz>
 */

namespace App\Shared\Middleware;

/**
 * PSR-7 interfaces
 * @see http://www.php-fig.org/psr/psr-7/
 */
use Psr\Http\Message\{RequestInterface, ResponseInterface};

interface MiddlewareInterface
{
     /**
     * @param RequestInterface $request
     * @param ResponseInterface $response
     * @param callable $next
     *
     * @return ResponseInterface
     */
    public function __invoke(RequestInterface $request, ResponseInterface $response, callable $next);
}
