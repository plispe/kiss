<?php

/**
 * PSR-7 relay PHP-DI factory
 *
 * @see http://relayphp.com/
 * @author Petr Pliska <petr.pliska@post.cz>
 */

namespace  App\Factory\Http;

use Relay\RelayBuilder;

/**
 * Interop DI intervace
 * @see https://github.com/container-interop/container-interop
 */
use Interop\Container\ContainerInterface;

class Relay
{
    /**
     * @param ContainerInterface $c)
     * @return RelayBuilder
     */
    public function create(ContainerInterface $c)
    {
        $builder = new RelayBuilder(function ($middleware) use ($c) {
            /**
            * Inject dependencies in middleware if PHP-DI is used
            * @see http://php-di.org/doc/inject-on-instance.html
            */
            if ($c instanceof \DI\Container) {
                $c->injectOn($middleware);
            }

            return $middleware;
        });

        return $builder->newInstance($c->get('middlewares'));
    }
}
