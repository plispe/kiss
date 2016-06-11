<?php

namespace App\ServiceProvider;

/**
 * Interop DI intervace
 * @see https://github.com/container-interop/container-interop
 */
use Interop\Container\ContainerInterface;
use Interop\Container\ServiceProvider;

/**
 * @see https://latte.nette.org/cs/
 */
use Latte\Engine;

/**
 * Class Latte
 * @package App\ServiceProvider
 * @author Petr Pliska <petr.pliska@post.cz>
 */
class Latte implements ServiceProvider
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
            Engine::class => function (ContainerInterface $container) {
                $engine = new Engine;

                if (getenv('USE_LATTE_CACHE') !== 'false') {
                    $engine->setTempDirectory($container->get('templates.cache.dir'));
                }

                return $engine;
            }
        ];
    }
}
