<?php

/**
 * Stash cache PHP-DI factory
 *
 * @see http://www.stashphp.com/
 * @author Petr Pliska <petr.pliska@post.cz>
 */
namespace App\Factory\Cache;

use Stash\Pool;
use Stash\Driver\FileSystem;
use Interop\Container\ContainerInterface;

class Stash
{
    /**
     * @param ContainerInterface $c
     * @return Pool
     */
    public function create(ContainerInterface $c)
    {
        $driver = new FileSystem;
        $driver->setOptions(['path' => $c->get('stash.cache.dir')]);

        return new Pool($driver);
    }
}
