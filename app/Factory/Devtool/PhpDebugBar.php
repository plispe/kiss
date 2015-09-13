<?php

/**
 * PhpDebugBar factory
 *
 * @see http://phpdebugbar.com/
 *
 * @author Petr Pliska <petr.pliska@post.cz>
 */
namespace App\Factory\Devtool;

/**
 *  @see http://phpdebugbar.com/
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

class PhpDebugBar
{
    /**
     * @param ContainerInterface $c
     *
     * @return PhpDebugBarMiddleware
     */
    public function create(ContainerInterface $c)
    {
        $debugbar = new StandardDebugBar();
        $debugbarRenderer = $debugbar->getJavascriptRenderer('/php-debugbar');
        $middleware = new PhpDebugBarMiddleware($debugbarRenderer);

        return $middleware;
    }
}
