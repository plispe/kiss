<?php

namespace App\ServiceProvider;

/**
 * Standard service providers
 * @see https://github.com/container-interop/service-provider
 */
use Interop\Container\ServiceProvider;

/**
 * @see http://www.pomm-project.org/
 */
use PommProject\ModelManager\SessionBuilder;

/**
 * Class Pomm
 * @package App\ServiceProvider
 * @author Petr Pliska <petr.pliska@post.cz>
 */
class Pomm implements ServiceProvider
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
            PommProject\Foundation\Pomm::class => function () {
                return new Pomm(['db' => [
                    'dsn' => getenv('DATABASE_DSN'),
                    'class:session_builder' => SessionBuilder::class
                ]]);
            }
        ];
    }
}
