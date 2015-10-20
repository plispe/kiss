<?php

/**
 * Monolog factory
 * @see https://github.com/Seldaek/monolog
 *
 * @author Petr Pliska <petr.pliska@post.cz>
 */

namespace App\Factory\Logger;

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
 * Interop DI intervace
 * @see https://github.com/container-interop/container-interop
 */
use Interop\Container\ContainerInterface;

class Monolog
{
    /**
     * @param ContainerInterface $c
     *
     * @return Logger
     */
    public function create(ContainerInterface $c)
    {
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
