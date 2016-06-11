<?php

namespace App\ServiceProvider;

/**
 * Stash cache PHP-DI factory
 *
 * @see http://www.stashphp.com/
 * @author Petr Pliska <petr.pliska@post.cz>
 */
use Stash\Pool;
use Stash\Driver\FileSystem;

/**
 * Interop DI intervace
 * @see https://github.com/container-interop/container-interop
 */
use Interop\Container\ContainerInterface;
use Interop\Container\ServiceProvider;

/**
 * Class Stash
 * @package App\ServiceProvider
 * @author Petr Pliska <petr.pliska@post.cz>
 */
class Stash implements ServiceProvider
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
            Pool::class => function (ContainerInterface $container) {
                $driver = new FileSystem(['path' => $container->get('stash.cache.dir')]);
                //$driver = new \Stash\Driver\Redis(['servers' => ['127.0.0.1', '6379']]);
                $pool = new Pool($driver);

                return $pool;
            }
        ];
    }
}
