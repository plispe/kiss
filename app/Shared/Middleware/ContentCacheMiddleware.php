<?php

/**
 * @author Petr Pliska <petr.pliska@post.cz>
 */

namespace App\Shared\Middleware;

/**
 * PSR-7 interfaces
 * @see http://www.php-fig.org/psr/psr-7/
 */
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\RequestInterface;

class ContentCacheMiddleware implements MiddlewareInterface
{

    protected $cache;

    public function __invoke(RequestInterface $request, ResponseInterface $response, callable $next)
    {
        $key = (string) $request->getUri();

        return $next($request, $response, $next);
    }
}
