<?php

namespace App\Factory;

/**
 * PhpDebugBar factory
 *
 * @see http://phpdebugbar.com/
 * @author Petr Pliska <petr.pliska@post.cz>
 */
use DebugBar\StandardDebugBar;

/**
 * @see https://github.com/php-middleware/phpdebugbar
 */
use PhpMiddleware\PhpDebugBar\PhpDebugBarMiddleware;

/**
 * Interop DI intervace
 * @see https://github.com/container-interop/container-interop
 */
use Interop\Container\ContainerInterface;

if (! function_exists('App\Factory\phpDebugBar'))
{
    /**
     * @param ContainerInterface $c
     *
     * @return PhpDebugBarMiddleware
     */
    function phpDebugBar(ContainerInterface $c): PhpDebugBarMiddleware
    {
        $debugbar = new StandardDebugBar();
        $debugbarRenderer = $debugbar->getJavascriptRenderer('/php-debugbar');
        $middleware = new PhpDebugBarMiddleware($debugbarRenderer);

        return $middleware;
    }
}
