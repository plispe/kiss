<?php

/**
 * Defines services for template rendering
 *
 * @author Petr Pliska <petr.pliska@post.cz>
 */

/**
 * Service classes and interfaces
 */
use Latte\Engine;

/**
 * Used Factories
 */
use App\Factory\Template\Latte;

/**
 * Interop DI intervace
 * @see https://github.com/container-interop/container-interop
 */
use Interop\Container\ContainerInterface;

return [
    /**
     * Latte templating engine
     * @see http://latte.nette.org/en/
     */
    Engine::class => function ($c) {
        return (new Latte)->create($c);
    },
];
