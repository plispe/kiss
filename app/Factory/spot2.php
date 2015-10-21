<?php

namespace App\Factory;

/**
 * Spot2 PHP-DI factory
 *
 * @see http://phpdatamapper.com/
 * @author Petr Pliska <petr.pliska@post.cz>
 */
use Spot\{Config, Locator};

/**
 * Interop DI intervace
 * @see https://github.com/container-interop/container-interop
 */
use Interop\Container\ContainerInterface;

if (! function_exists('App\Factory\spot2'))
{
    /**
     * @param ContainerInterface $c
     * @return Locator
     */
    function spot2(ContainerInterface $c): Locator
    {
        $config = new Config;
        $config->addConnection(
            'mysql',
            $c->get('db.dsn')
        );

        return new Locator($config);
    }
}
