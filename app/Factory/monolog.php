<?php

namespace App\Factory;

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
use Monolog\Handler\{StreamHandler, ChromePHPHandler};

/**
 * Monolog Processors
 */
use Monolog\Processor\{WebProcessor, IntrospectionProcessor};

/**
 * @see http://www.php-fig.org/psr/psr-3/
 */
use Psr\Log\LoggerInterface;

/**
 * Interop DI intervace
 * @see https://github.com/container-interop/container-interop
 */
use Interop\Container\ContainerInterface;

if (!function_exists('App\Factory\monolog')) {
    /**
     * @param ContainerInterface $c
     *
     * @return LoggerInterface
     */
    function monolog(ContainerInterface $c): LoggerInterface {
        $logger = new Logger("Monolog");
        $logger->pushProcessor(new WebProcessor);
        $logger->pushProcessor(new IntrospectionProcessor);

        /**
         * If chrome logger is used
         * @see https://craig.is/writing/chrome-logger
         */
        if (getenv('USE_CHROME_LOGGER') === 'true') {
            $logger->pushHandler(new ChromePHPHandler);
        }

        $logger->pushHandler(new StreamHandler('php://stderr'));

        return $logger;
    }
}
