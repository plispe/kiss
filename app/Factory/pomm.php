<?php

namespace App\Factory;

/**
 * Pomm PHP-DI factory
 *
 * @see http://www.pomm-project.org/
 * @author Petr Pliska <petr.pliska@post.cz>
 */

use PommProject\Foundation\Pomm;
use PommProject\ModelManager\SessionBuilder;

/**
 * Interop DI intervace
 * @see https://github.com/container-interop/container-interop
 */
use Interop\Container\ContainerInterface;

if (! function_exists('App\Factory\pomm'))
{
    /**
     * @param ContainerInterface $c
     * @return PommProject\Foundation\Pomm
     */
    function pomm(ContainerInterface $c): Pomm
    {
        return new Pomm(['db' => [
            'dsn' => $c->get('db.dsn'),
            'class:session_builder' => SessionBuilder::class
        ]]);
    }
}
