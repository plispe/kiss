<?php

/**
 * Clockwork factory
 *
 * @see https://github.com/itsgoingd/clockwork
 * @author Petr Pliska <petr.pliska@post.cz>
 */
namespace App\Factory\Devtool;

use Clockwork\DataSource\PhpDataSource;
use Clockwork\Storage\FileStorage;

use Interop\Container\ContainerInterface;

class Clockwork
{
    /**
     * @param ContainerInterface $c
     */
    public function create(ContainerInterface $c)
    {

        $clockwork = new \Clockwork\Clockwork;
        $clockwork
            ->addDataSource(new PhpDataSource())
            ->setStorage(new FileStorage($c->get('clockwork.dir')));

        $clockwork->startEvent('init', 'Application init');
        return $clockwork;
    }
}
