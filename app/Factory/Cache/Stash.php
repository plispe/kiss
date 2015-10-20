<?php

/**
 * Stash cache PHP-DI factory
 *
 * @see http://www.stashphp.com/
 * @author Petr Pliska <petr.pliska@post.cz>
 */
namespace App\Factory\Cache;

use Stash\{Pool, Driver\FileSystem};

/**
 * Interop DI intervace
 * @see https://github.com/container-interop/container-interop
 */
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

        // $driver = new \Stash\Driver\Redis;
        // $driver->setOptions(['servers' => ['127.0.0.1', '6379']]);

        return new Pool($driver);
    }
}
