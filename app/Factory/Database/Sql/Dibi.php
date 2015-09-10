<?php

/**
 * Dibi PHP-DI factory
 *
 * @see http://dibiphp.com/
 * @author Petr Pliska <petr.pliska@post.cz>
 */

namespace App\Factory\Database\Sql;

use AD7six\Dsn\DbDsn;
use Interop\Container\ContainerInterface;

class Dibi
{
    /**
     * @param ContainerInterface $c
     * @return DibiConnection
     */
    public function create(ContainerInterface $c)
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

        return new \DibiConnection($connection);
    }
}
