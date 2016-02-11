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

/**
 * PSR-6  cache standard
 * @see http://www.php-fig.org/psr/psr-6/
 */
use \Psr\Cache\CacheItemPoolInterface;

if (! function_exists('App\Factory\stash')) {
    /**
     * @param ContainerInterface $c
     * @return Pool
     */
    function stash(ContainerInterface $c): CacheItemPoolInterface
    {
        $driver = new FileSystem(['path' => $c->get('stash.cache.dir')]);
//        $driver = new \Stash\Driver\Redis(['servers' => ['127.0.0.1', '6379']]);
        $pool = new Pool($driver);

        return $pool;
    }
}
