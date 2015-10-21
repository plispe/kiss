<?php


namespace App\Factory;

/**
 * Event emitter factory
 *
 * @see http://event.thephpleague.com/2.0/
 * @author Petr Pliska <petr.pliska@post.cz>
 */
use League\Event\Emitter;

/**
 * Interop DI intervace
 * @see https://github.com/container-interop/container-interop
 */
use Interop\Container\ContainerInterface;

if (! function_exists('App\Factory\eventEmitter'))
{
    /**
     * @param ContainerInterface $c
     * @return Emitter
     */
    function eventEmitter(ContainerInterface $c): Emitter
    {
        $emitter =  new Emitter;
        $emitter->addListener('*', function ($event) {
            var_dump($event);
        });

        return $emitter;
    }
}
