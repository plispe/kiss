<?php

/**
 * Monga PHP-DI factory
 *
 * @see https://github.com/thephpleague/monga
 * @author Petr Pliska <petr.pliska@post.cz>
 */

namespace App\Factory;

use AD7six\Dsn\DbDsn;

/**
 * Interop DI intervace
 * @see https://github.com/container-interop/container-interop
 */
use Interop\Container\ContainerInterface;

if (! function_exists('App\Factory\monga'))
{
    /**
     * @param ContainerInterface $c
     * @return \League\Monga\Database
     */
    function monga(ContainerInterface $c)
    {
        /**
         * uses AD7six/php-dsn utility for parsing database DSN
         * @see https://github.com/AD7six/php-dsn
         */
        $dsn        = new DbDsn($c->get('db.dsn'));

        $connection = \League\Monga::connection($c->get('db.dsn'));

        return $connection->database($dsn->getDatabase());
    }
}
