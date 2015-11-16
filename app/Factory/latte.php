<?php

namespace App\Factory;

/**
 * Latte templating engine PHP-DI factory
 *
 * @see http://latte.nette.org/en/
 * @author Petr Pliska <petr.pliska@post.cz>
 */
use Latte\Engine;

/**
 * Interop DI intervace
 * @see https://github.com/container-interop/container-interop
 */
use Interop\Container\ContainerInterface;

if (! function_exists('App\Factory\latte')) {
    /**
     * @param ContainerInterface $c
     * @return Engine
     */
    function latte(ContainerInterface $c): Engine
    {
        $engine = new Engine;

        if (getenv('USE_LATTE_CACHE') === 'true') {
            $engine->setTempDirectory($c->get('templates.cache.dir'));
        }

        return $engine;
    }
}
