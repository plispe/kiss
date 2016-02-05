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
use Aura\Router\{Route, RouterContainer};

use App\Vendor\Aura\Router\Map\RestfulResourceMap;

if (! function_exists('App\Factory\auraRoterContainer')) {
    /**
     * @param ContainerInterface $c)
     * @return RouterContainer
     */
    function auraRoterContainer(ContainerInterface $c): RouterContainer
    {
        $container = new RouterContainer;
        return $container;
    }
}
