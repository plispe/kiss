<?php

/**
 * @see http://event.thephpleague.com/2.0/
 * @author Petr Pliska <petr.pliska@post.cz>
 */
namespace App\Factory\Event;

use League\Event\Emitter;

/**
 * Interop DI intervace
 * @see https://github.com/container-interop/container-interop
 */
use Interop\Container\ContainerInterface;

class League
{
    /**
     * @param ContainerInterface $c
     * @return Emitter
     */
    public function create(ContainerInterface $c)
    {
        $emitter =  new Emitter;
        $emitter->addListener('*', function ($event) {
            var_dump($event);
        });

        return $emitter;
    }
}
