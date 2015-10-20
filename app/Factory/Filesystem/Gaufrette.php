<?php

/**
 * Gaufrette PHP-DI factory
 *
 * @author Petr Pliska <petr.pliska@post.cz>
 * @see http://flysystem.thephpleague.com/
 */

namespace App\Factory\Filesystem;

use Gaufrette\{Filesystem, Adapter\Local};

/**
 * Interop DI intervace
 * @see https://github.com/container-interop/container-interop
 */
use Interop\Container\ContainerInterface;

class Gaufrette
{
    /**
     * @param ContainerInterface $c
     * @return Filesystem
     */
    public function create(ContainerInterface $c)
    {
        $adapter = new LocalAdapter($c->get('files.dir'));
        $filesystem = new Filesystem($adapter);

        return $filesystem;
    }
}
