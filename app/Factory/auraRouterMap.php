<?php

/**
 * @author Petr Pliska <petr.pliska@post.cz>
 */
namespace App\Factory;

/**
 * Interop DI intervace
 * @see https://github.com/container-interop/container-interop
 */
use Interop\Container\ContainerInterface;

/**
 * Aura.Router classes
 * @see http://auraphp.com/packages/Aura.Router/
 */
use Aura\Router\{Map, Generator, RouterContainer};

if (! function_exists('App\Factory\auraRouterMap')) {
    /**
     * @param ContainerInterface $c)
     * @return Map
     */
    function auraRouterMap(ContainerInterface $c)
    {
        return $c->call(function (RouterContainer $container) use ($c) {
            $map = $container->getMap();
            require_once sprintf('%sroutes.php', $c->get('config.dir'));
            return $map;
        });
    }
}
