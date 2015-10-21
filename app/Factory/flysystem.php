<?php

namespace App\Factory;

/**
 * Flysystem PHP-DI factory
 *
 * @author Petr Pliska <petr.pliska@post.cz>
 * @see http://flysystem.thephpleague.com/
 */
use League\Flysystem\{
    Filesystem, MountManager, Adapter\Local
};

/**
 * Interop DI intervace
 * @see https://github.com/container-interop/container-interop
 */
use Interop\Container\ContainerInterface;

if (! function_exists('App\Factory\flysystem')) {
    /**
     * @param ContainerInterface $c
     * @return MountManager
     */
    function flysystem(ContainerInterface $c): MountManager
    {
        $localAdapter    = new Local($c->get('files.dir'));
        $localFilesystem = new Filesystem($localAdapter);

        return new MountManager([
            'files' => $localFilesystem
        ]);
    }
}
