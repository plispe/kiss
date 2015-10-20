<?php

/**
 * @author Petr Pliska <petr.pliska@post.cz>
 */
namespace App\Factory\Http;

/**
 * Interop DI intervace
 * @see https://github.com/container-interop/container-interop
 */
use Interop\Container\ContainerInterface;

/**
 * Aura.Router classes
 * @see http://auraphp.com/packages/Aura.Router/
 */
use Aura\Router\{Map, Route, Matcher, Generator, RouterContainer};

use App\Vendor\Aura\Router\Map\RestfulResourceMap;

class Router
{
    /**
     * @param ContainerInterface $c)
     * @return RouterContainer
     */
    public function createRouterContainer(ContainerInterface $c)
    {
        $container = new RouterContainer;
        $container->setMapFactory(function () {
            return new RestfulResourceMap(new Route());
        });

        return $container;
    }

    /**
     * @param ContainerInterface $c)
     * @return Map
     */
    public function createMap(ContainerInterface $c)
    {
        $map = $c->get(RouterContainer::class)->getMap();

        require_once sprintf('%sroutes.php', $c->get('config.dir'));

        return $map;
    }

    /**
     * @param ContainerInterface $c)
     * @return Matcher
     */
    public function createMatcher(ContainerInterface $c)
    {
        $map = $c->get(Map::class);
        return $c->get(RouterContainer::class)->getMatcher();
    }

    /**
     * @param ContainerInterface $c)
     * @return Generator
     */
    public function createGenerator(ContainerInterface $c)
    {
        return $c->get(RouterContainer::class)->getGenerator();
    }
}
