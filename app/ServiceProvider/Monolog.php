<?php

namespace App\ServiceProvider;

/**
 * Monolog factory
 * @see https://github.com/Seldaek/monolog
 *
 * @author Petr Pliska <petr.pliska@post.cz>
 */
use Monolog\Logger;

/**
 * Monolog handlers
 */
use Monolog\Handler\StreamHandler;

/**
 * Monolog Processors
 */
use Monolog\Processor\WebProcessor;
use Monolog\Processor\IntrospectionProcessor;

/**
 * @see http://www.php-fig.org/psr/psr-3/
 */
use Psr\Log\LoggerInterface;

/**
 * Interop DI intervace
 * @see https://github.com/container-interop/container-interop
 */
use Interop\Container\ContainerInterface;
use Interop\Container\ServiceProvider;

/**
 * Class Monolog
 * @package App\ServiceProvider
 * @author Petr Pliska <petr.pliska@post.cz>
 */
class Monolog implements ServiceProvider
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
           LoggerInterface::class => function (ContainerInterface $container) {
               $logger = new Logger("Monolog");
               $logger->pushProcessor(new WebProcessor);
               $logger->pushProcessor(new IntrospectionProcessor);

               // $logger->pushHandler(new ChromePHPHandler);
               $logger->pushHandler(new StreamHandler('php://stderr'));

               return $logger;
           }
       ];
    }
}
