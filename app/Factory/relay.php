<?php

namespace  App\Factory;

/**
 * PSR-7 relay PHP-DI factory
 *
 * @see http://relayphp.com/
 * @author Petr Pliska <petr.pliska@post.cz>
 */
use Relay\Runner;

/**
 * Interop DI intervace
 * @see https://github.com/container-interop/container-interop
 */
use Interop\Container\ContainerInterface;

if (! function_exists('App\Factory\relay')) {
    /**
     * @param ContainerInterface $c)
     * @return RelayBuilder
     */
    function relay(ContainerInterface $c)
    {
        return new Runner($c->get('middlewares'), function ($middleware) use ($c) {
            /**
            * Inject dependencies in middleware if PHP-DI is used
            * @see http://php-di.org/doc/inject-on-instance.html
            */
            if ($c instanceof \DI\Container) {
                $c->injectOn($middleware);
            }

            return $middleware;
        });
    }
}
