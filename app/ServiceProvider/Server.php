<?php

namespace App\ServiceProvider;

/**
 * PSR-7 middleware dispatcher
 * @see http://relayphp.com/
 */
use Relay\Runner;

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
 * Zend diactoros server
 * @see https://zendframework.github.io/zend-diactoros/
 */
use Zend\Diactoros\ServerRequestFactory;

/**
 * PSR-7 server interface
 * @see http://www.php-fig.org/psr/psr-7/
 */
use Psr\Http\Message\ServerRequestInterface;

/**
 * Class Relay
 * @package App\ServiceProvider
 * @author Petr Pliska <petr.pliska@post.cz>
 */
class Server implements ServiceProvider
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
            Runner::class => function (ContainerInterface $container) {
                return new Runner($container->get('middlewares'), function ($middleware) use ($container) {
                    /**
                     * Inject dependencies in middleware if PHP-DI is used
                     * @see http://php-di.org/doc/inject-on-instance.html
                     */
                    if ($container instanceof \DI\Container) {
                        $container->injectOn($middleware);
                    }

                    return $middleware;
                });
            },

            \Zend\Diactoros\Server::class => function (ContainerInterface $container) {
                return \Zend\Diactoros\Server::createServerfromRequest(
                    $container->get(Runner::class),
                    $container->get(ServerRequestInterface::class)
                );
            },

            ServerRequestInterface::class => function () {
                return ServerRequestFactory::fromGlobals();
            }
        ];
    }
}
