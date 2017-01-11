<?php

namespace App\ServiceProvider;

/**
 * Gaufrette PHP-DI factory
 *
 * @author Petr Pliska <petr.pliska@post.cz>
 * @see http://flysystem.thephpleague.com/
 */
use Gaufrette\Filesystem;
use Gaufrette\Adapter\Local as LocalAdapter;

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
 * Class Gaufrette
 * @package App\ServiceProvider
 */
class Gaufrette implements ServiceProvider
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
    public function getServices(): array
    {
        return [
            Filesystem::class => function (ContainerInterface $container) {
                $adapter = new LocalAdapter($container->get('files.dir'));
                $filesystem = new Filesystem($adapter);

                return $filesystem;
            }
        ];
    }
}
