<?php

/**
 * Clockwork factory
 *
 * @see https://github.com/itsgoingd/clockwork
 * @author Petr Pliska <petr.pliska@post.cz>
 */
namespace App\Factory\Devtool;

use Clockwork\{
    Storage\FileStorage,
    DataSource\PhpDataSource
};


/**
 * Interop DI intervace
 * @see https://github.com/container-interop/container-interop
 */
use Interop\Container\ContainerInterface;

class Clockwork
{
    /**
     * @param ContainerInterface $c
     *
     * @return Clockwork\Clockwork
     */
    public function create(ContainerInterface $c): \Clockwork\Clockwork
    {

        $clockwork = new \Clockwork\Clockwork;
        $clockwork
            ->addDataSource(new PhpDataSource())
            ->setStorage(new FileStorage($c->get('clockwork.dir')));

        $clockwork->startEvent('init', 'Application init');
        return $clockwork;
    }
}
