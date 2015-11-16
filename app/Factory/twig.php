<?php

/**
 * Twig template engine factory
 *
 * @see http://twig.sensiolabs.org/
 * @author Petr Pliska <petr.pliska@post.cz>
 */
namespace App\Factory;

/**
 * Interop DI intervace
 * @see https://github.com/container-interop/container-interop
 */
use Interop\Container\ContainerInterface;

if (! function_exists('App\Factory\twig')) {
    /**
     * @param ContainerInterface $c
     * @return
     */
    function twig(ContainerInterface $c)
    {
        $loader = new \Twig_Loader_Filesystem($c->get('templates.dir'));
        $twig = new \Twig_Environment($loader, [
            'cache' => $c->get('templates.cache.dir'),
        ]);

        return $twig;
    }
}



