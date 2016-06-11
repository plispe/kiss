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
 * Tactician command bus implementation
 * @see http://tactician.thephpleague.com/
 */
use League\Tactician\Handler\Locator\CallableLocator;
use League\Tactician\Handler\CommandHandlerMiddleware;
use League\Tactician\Handler\MethodNameInflector\InvokeInflector;
use League\Tactician\Handler\CommandNameExtractor\ClassNameExtractor;

/**
 * Class CommandBus
 * @package App\ServiceProvider
 * @author Petr Pliska <petr.pliska@post.cz>
 */
class CommandBus implements ServiceProvider
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
            \League\Tactician\CommandBus::class => function (ContainerInterface $container) {
                return new CommandBus([
                    new CommandHandlerMiddleware(
                        new ClassNameExtractor,
                        new CallableLocator(function ($command) use ($container) {
                            return $container->get(str_replace("\\Command\\", "\\CommandHandler\\", $command));
                        }),
                        new InvokeInflector
                    )
                ]);
            }
        ];
    }
}
