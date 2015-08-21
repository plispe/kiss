<?php

/**
 * Flysystem PHP-DI factory
 *
 * @author Petr Pliska <petr.pliska@post.cz>
 * @see http://flysystem.thephpleague.com/
 */
namespace App\Factory\Filesystem;

use League\Flysystem\Filesystem;
use League\Flysystem\MountManager;
use League\Flysystem\Adapter\Local;
use Interop\Container\ContainerInterface;

class Flysystem
{
    /**
     * @param ContainerInterface $c
     * @return MountManager
     */
    public function create(ContainerInterface $c)
    {
        $localAdapter    = new Local($c->get('files.dir'));
        $localFilesystem = new Filesystem($localAdapter);

        return new MountManager([
            'files' => $localFilesystem
        ]);
    }
}
