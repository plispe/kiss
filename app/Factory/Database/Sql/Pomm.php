<?php

/**
 * Pomm PHP-DI factory
 *
 * @see http://www.pomm-project.org/
 * @author Petr Pliska <petr.pliska@post.cz>
 */

namespace App\Factory\Database\Sql;

use Interop\Container\ContainerInterface;
use PommProject\ModelManager\SessionBuilder;

class Pomm
{
    /**
     * @param ContainerInterface $c
     * @return PommProject\Foundation\Pomm
     */
    public function create(ContainerInterface $c)
    {
        return new \PommProject\Foundation\Pomm(['db' => [
            'dsn' => $c->get('db.dsn'),
            'class:session_builder' => SessionBuilder::class
        ]]);
    }
}
