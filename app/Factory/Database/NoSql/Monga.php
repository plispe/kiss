<?php

/**
 * Monga PHP-DI factory
 *
 * @see https://github.com/thephpleague/monga
 * @author Petr Pliska <petr.pliska@post.cz>
 */

namespace App\Factory\Database\NoSql;

use AD7six\Dsn\DbDsn;
use Interop\Container\ContainerInterface;

class Monga
{
    /**
     * @param ContainerInterface $c
     * @return League\Monga\Database
     */
    public function create(ContainerInterface $c)
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
