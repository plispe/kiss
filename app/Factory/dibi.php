<?php

/**
 * Dibi PHP-DI factory
 *
 * @see http://dibiphp.com/
 * @author Petr Pliska <petr.pliska@post.cz>
 */

namespace App\Factory;

use Dibi\Connection;
use AD7six\Dsn\DbDsn;

/**
 * Interop DI intervace
 * @see https://github.com/container-interop/container-interop
 */
use Interop\Container\ContainerInterface;

if (! function_exists('App\Factory\dibi'))
{
    /**
     * @param ContainerInterface $c
     * @return Connection
     */
    function dibi(ContainerInterface $c): Connection
    {
        /**
         * uses AD7six/php-dsn utility for parsing database DSN
         * @see https://github.com/AD7six/php-dsn
         */
        $dsn = new DbDsn($c->get('db.dsn'));

        $connection = [
            'driver'   => $dsn->getEngine(),
            'host'     => $dsn->getHost(),
            'user' => $dsn->getUser(),
            'password' => $dsn->getPassword(),
            'database' => $dsn->getDatabase(),
        ];

        return new Connection($connection);
    }
}
