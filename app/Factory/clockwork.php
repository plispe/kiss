<?php

namespace App\Factory;

/**
 * Clockwork factory
 *
 * @see https://github.com/itsgoingd/clockwork
 * @author Petr Pliska <petr.pliska@post.cz>
 */
use Clockwork\{Clockwork, Storage\FileStorage, DataSource\PhpDataSource};

/**
 * Interop DI intervace
 * @see https://github.com/container-interop/container-interop
 */
use Interop\Container\ContainerInterface;

if (! function_exists('App\Factory\clockwork')) {
    /**
     * @param ContainerInterface $c
     *
     * @return Clockwork
     */
    function clockwork(ContainerInterface $c): Clockwork
    {
        $clockwork = new Clockwork;
        $clockwork
            ->addDataSource(new PhpDataSource())
            ->setStorage(new FileStorage($c->get('clockwork.dir')));

        return $clockwork;
    }
}
