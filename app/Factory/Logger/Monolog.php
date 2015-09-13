<?php

/**
 * Monolog factory
 * @see https://github.com/Seldaek/monolog
 *
 * @author Petr Pliska <petr.pliska@post.cz>
 */

namespace App\Factory\Logger;

use Monolog\Logger;
use Monolog\Handler\ErrorLogHandler;

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
        $logger = new Logger("log");
        $logger->pushHandler(new ErrorLogHandler());

        return $logger;
    }
}
