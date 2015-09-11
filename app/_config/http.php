<?php

/**
 * @author Petr Pliska <petr.pliska@post.cz>
 */

/**
 * Used factories
 */
use App\Factory\Http\Psr7;
use App\Factory\Http\Relay as RelayFactory;

/**
 * Middleware dispatcher
 * @see http://relayphp.com/
 */
use Relay\Relay;

/**
 * Aura.Router classes
 * @see http://auraphp.com/packages/Aura.Router/
 */
use Aura\Router\Map;
use Aura\Router\Matcher;
use Aura\Router\Generator;
use Aura\Router\RouterContainer;
use Aura\Router\Route;

/**
 * PSR-7 interfaces
 * @see http://www.php-fig.org/psr/psr-7/
 */
use Psr\Http\Message\RequestInterface;
use Psr\Http\Message\ResponseInterface;

/**
 * Interop DI intervace
 * @see https://github.com/container-interop/container-interop
 */
use Interop\Container\ContainerInterface;

use App\Vendor\Aura\Router\Map\RestfulResourceMap;

return [
    /**
     * PSR-7 Middleware dispatcher
     * @see http://relayphp.com/
     */
    Relay::class => DI\factory([RelayFactory::class, 'create']),

    /**
     * PSR-7 router
     * @see http://auraphp.com/packages/Aura.Router/
     */

    RouterContainer::class => function (ContainerInterface $c) {
        $container = new RouterContainer;
        $container->setMapFactory(function () {
            return new RestfulResourceMap(new Route());
        });

        return $container;
    },


    Map::class => function (ContainerInterface $c) {
        return $c->get(RouterContainer::class)->getMap();
    },
    Matcher::class => function (ContainerInterface $c) {
        $map = $c->get(Map::class);
        return $c->get(RouterContainer::class)->getMatcher();
    },
    Generator::class => function (ContainerInterface $c) {
        return $c->get(RouterContainer::class)->getGenerator();
    },
];
