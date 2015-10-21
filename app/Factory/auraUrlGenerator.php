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
use Aura\Router\RouterContainer;

if (! function_exists('App\Factory\auraUrlGenerator'))
{
    /**
     * @param ContainerInterface $c)
     * @return Generator
     */
    function auraUrlGenerator(ContainerInterface $c)
    {
        return $c->call(function (RouterContainer $container) {
            return $container->getGenerator();
        });
    }
}
