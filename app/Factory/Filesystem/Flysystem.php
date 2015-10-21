<?php

/**
 * Flysystem PHP-DI factory
 *
 * @author Petr Pliska <petr.pliska@post.cz>
 * @see http://flysystem.thephpleague.com/
 */
namespace App\Factory\Filesystem;

use League\Flysystem\{
    Filesystem, MountManager, Adapter\Local
};

/**
 * Interop DI intervace
 * @see https://github.com/container-interop/container-interop
 */
use Interop\Container\ContainerInterface;

class Flysystem
{
    /**
     * @param ContainerInterface $c
     * @return MountManager
     */
    public function create(ContainerInterface $c): MountManager
    {
        $localAdapter    = new Local($c->get('files.dir'));
        $localFilesystem = new Filesystem($localAdapter);

        return new MountManager([
            'files' => $localFilesystem
        ]);
    }
}
