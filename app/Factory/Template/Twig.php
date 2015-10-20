<?php

/**
 * Twig template engine factory
 *
 * @see http://twig.sensiolabs.org/
 * @author Petr Pliska <petr.pliska@post.cz>
 */
namespace App\Factory\Template;

/**
 * Interop DI intervace
 * @see https://github.com/container-interop/container-interop
 */
use Interop\Container\ContainerInterface;

class Twig
{
    /**
     * @param ContainerInterface $c
     * @return
     */
    public function create(ContainerInterface $c)
    {
        $loader = new Twig_Loader_Filesystem($c->get('templates.dir'));
        $twig = new Twig_Environment($loader, array(
            $c->get('twig.cache.dir'),
        ));

        return $twig;
    }
}


// echo $twig->render('index.html', array('name' => 'Fabien'));
