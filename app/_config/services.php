<?php

/**
 * Defines other useful services such as caching, event dispatching etc.
 *
 * @author Petr Pliska <petr.pliska@post.cz>
 */

/**
 * Service classes and interfaces
 */
use Stash\Interfaces\PoolInterface;
use League\Flysystem\MountManager;
use League\Event\Emitter;
use Clockwork\Clockwork;
use AdamWathan\Form\FormBuilder;

/**
 * Used factories
 */
use App\Factory\Cache\Stash;
use App\Factory\Event\League;
use App\Factory\Devtool\Clockwork as ClockworkFactory;
use App\Factory\Filesystem\Flysystem;
use App\Factory\Html\Form;

/**
 * Interop DI intervace
 * @see https://github.com/container-interop/container-interop
 */
use Interop\Container\ContainerInterface;

return [
    /**
     * Caching library
     * @see http://www.stashphp.com/
     */
    PoolInterface::class => function (ContainerInterface $c) {
        return (new Stash)->create($c);
    },

    /**
     * Flysystem - filesystem abstraction
     * @see http://flysystem.thephpleague.com/
     */
    MountManager::class => function (ContainerInterface $c) {
        return (new Flysystem)->create();
    },

    /**
     * Event emitter
     * @see http://event.thephpleague.com/2.0/
     */
    Emitter::class => function (ContainerInterface $c) {
        return (new League)->create();
    },

    /**
     * Clockwork
     * @see https://github.com/itsgoingd/clockwork
     */
    Clockwork::class => function (ContainerInterface $c) {
        return (new ClockworkFactory)->create($c);
    },

    /**
     * Form Builder
     * @see https://github.com/adamwathan/form
     *
     * @todo replace with former @see http://formers.github.io/former/ (when possible)
     */
    FormBuilder::class > function (ContainerInterface $c) {
        return (new Form)->create($c);
    }
];
