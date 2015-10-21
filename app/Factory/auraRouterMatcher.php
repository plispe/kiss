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
use Aura\Router\{Map, RouterContainer};

if (! function_exists('App\Factory\auraRouterMatcher'))
{
    /**
     * @param ContainerInterface $c)
     * @return Matcher
     */
    function auraRouterMatcher(ContainerInterface $c)
    {
        return $c->call(function(Map $map, RouterContainer $container) {
            return $container->getMatcher();
        });
    }
}
