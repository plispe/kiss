<?php

namespace App\Factory;

/**
 * Interop DI intervace
 * @see https://github.com/container-interop/container-interop
 */
use Interop\Container\ContainerInterface;

/**
 * @see https://github.com/XiaoLer/blade
 * @see http://laravel.com/docs/5.1/blade
 */
use Xiaoler\Blade\Factory;
use Xiaoler\Blade\FileViewFinder;
use Xiaoler\Blade\Engines\CompilerEngine;
use Xiaoler\Blade\Compilers\BladeCompiler;

if (! function_exists('App\Factory\blade')) {
    function blade(ContainerInterface $c) {
        $compiler = new BladeCompiler($c->get('templates.cache.dir'));
        $engine = new CompilerEngine($compiler);
        $finder = new FileViewFinder([$c->get('templates.dir')], ['blade']);

        return new class($engine, $finder) extends Factory {
            /**
             * @param  string $name
             * @return string
             */
            protected function normalizeName($name)
            {
                return $name;
            }
        };
    }
}
