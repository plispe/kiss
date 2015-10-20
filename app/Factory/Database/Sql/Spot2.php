<?php

/**
 * Spot2 PHP-DI factory
 *
 * @see http://phpdatamapper.com/
 * @author Petr Pliska <petr.pliska@post.cz>
 */

namespace App\Factory\Database\Sql;

use Spot\{Config, Locator};
use Interop\Container\ContainerInterface;

class Spot2
{
    /**
     * @param ContainerInterface $c
     * @return Locator
     */
    public function create(ContainerInterface $c)
    {
        $config = new Config;
        $config->addConnection(
            'mysql',
            $c->get('db.dsn')
        );

        return new Locator($config);
    }
}
