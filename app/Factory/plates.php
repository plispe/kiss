<?php

namespace App\Factory;

/**
 * Interop DI intervace
 * @see https://github.com/container-interop/container-interop
 */
use Interop\Container\ContainerInterface;

/**
 * Plates template engine
 * @see http://platesphp.com/
 */
use League\Plates\Engine;

if (! function_exists('App\Factory\plates')) {
    function plates(ContainerInterface $c) {
        return new Engine($c->get('templates.dir'), 'php');
    }
}
