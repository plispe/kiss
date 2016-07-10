<?php

namespace App\ServiceProvider;

/**
 * Interop DI intervace
 * @see https://github.com/container-interop/container-interop
 */
use Interop\Container\ContainerInterface;

/**
 * Standard service providers
 * @see https://github.com/container-interop/service-provider
 */
use Interop\Container\ServiceProvider;

/**
 * Aura.Router
 * @see http://auraphp.com/packages/Aura.Router/
 */
use Aura\Router\Map;
use Aura\Router\Matcher;
use Aura\Router\Generator;
use Aura\Router\RouterContainer;

/**
 * Class AuraRouter
 * @package App\ServiceProvider
 * @author Petr Pliska <petr.pliska@post.cz>
 */
class AuraRouter implements ServiceProvider
{
    /**
     * Returns a list of all container entries registered by this service provider.
     *
     * - the key is the entry name
     * - the value is a callable that will return the entry, aka the **factory**
     *
     * Factories have the following signature:
     *        function(ContainerInterface $container, callable $getPrevious = null)
     *
     * About factories parameters:
     *
     * - the container (instance of `Interop\Container\ContainerInterface`)
     * - a callable that returns the previous entry if overriding a previous entry, or `null` if not
     *
     * @return callable[]
     */
    public function getServices()
    {
        return [
            RouterContainer::class => $this->getRouterContainer(),
            Map::class => $this->getMap(),
            Matcher::class => $this->getMatcher(),
            Generator::class => $this->getGenerator()
        ];
    }

    /**
     * @return \Closure
     */
    protected function getRouterContainer()
    {
        return function () {
            return new RouterContainer;
        };
    }

    /**
     * @return \Closure
     */
    protected function getMap()
    {
        return function (ContainerInterface $container) {
            $map = $container->get(RouterContainer::class)->getMap();
            require_once sprintf('%sroutes.php', $container->get('config.dir'));
            return $map;
        };
    }

    /**
     * @return \Closure
     */
    protected function getMatcher()
    {
        return function (ContainerInterface $container) {
            $container->get(Map::class);
            return $container->get(RouterContainer::class)->getMatcher();
        };
    }

    /**
     * @return \Closure
     */
    protected function getGenerator()
    {
        return function (ContainerInterface $container) {
            return $container->get(RouterContainer::class)->getGenerator();
        };
    }
}
