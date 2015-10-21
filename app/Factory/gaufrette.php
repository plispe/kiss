<?php

namespace App\Factory;

/**
 * Gaufrette PHP-DI factory
 *
 * @author Petr Pliska <petr.pliska@post.cz>
 * @see http://flysystem.thephpleague.com/
 */
use Gaufrette\{Filesystem, Adapter\Local as LocalAdapter};

/**
 * Interop DI intervace
 * @see https://github.com/container-interop/container-interop
 */
use Interop\Container\ContainerInterface;

if (! function_exists('App\Factory\gaufrette')) {
    /**
     * @param ContainerInterface $c
     * @return Filesystem
     */
    function gaufrette(ContainerInterface $c): Filesystem
    {
        $adapter = new LocalAdapter($c->get('files.dir'));
        $filesystem = new Filesystem($adapter);

        return $filesystem;
    }
}
