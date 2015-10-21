<?php

namespace App\Factory;

/**
 * Stash cache PHP-DI factory
 *
 * @see http://www.stashphp.com/
 * @author Petr Pliska <petr.pliska@post.cz>
 */
use Stash\{Pool, Driver\FileSystem};

/**
 * Interop DI intervace
 * @see https://github.com/container-interop/container-interop
 */
use Interop\Container\ContainerInterface;

if (! function_exists('App\Factory\stash')) {
    /**
     * @param ContainerInterface $c
     * @return Pool
     */
    function stash(ContainerInterface $c): Pool
    {
        $driver = new FileSystem;
        $driver->setOptions(['path' => $c->get('stash.cache.dir')]);

        // $driver = new \Stash\Driver\Redis;
        // $driver->setOptions(['servers' => ['127.0.0.1', '6379']]);

        return new Pool($driver);
    }
}
