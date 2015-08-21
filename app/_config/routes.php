<?php

/**
 * Defines routes for Aura.Router
 * @see http://auraphp.com/packages/Aura.Router/defining-routes.html#2.2
 *
 * @author Petr Pliska <petr.pliska@post.cz>
 */

/**
 * Interop DI intervace
 * @see https://github.com/container-interop/container-interop
 */
use Interop\Container\ContainerInterface;

return [

    /**
     * Controller wildcards
     * @see http://php-di.org/doc/php-definitions.html#wildcards
     */
    '\App\Module\Web\Controller\*'   => DI\object('\App\Module\Web\Controller\*'),
    '\App\Module\Api\Controller\*'   => DI\object('\App\Module\Api\Controller\*'),
    '\App\Module\Admin\Controller\*' => DI\object('\App\Module\Admin\Controller\*'),

    /**
     * Using of PHP-DI decorator for routes definition
     * @see http://php-di.org/doc/definition-overriding.html#decorators
     */
    Aura\Router\Map::class => DI\decorate(
        function ($map, ContainerInterface $c) {
            /**
             * Default settings
             * @see http://auraphp.com/packages/Aura.Router/defining-routes.html#2.2.1
             */
            $map->tokens([
                // Allowed module prefixes are admin and api
                'module' => 'admin|api'
            ])->defaults([
                // Default module is web (without prefix)
                'module'     => 'web',
                // No default controller
                'controller' => null,
                // Default action id "default"
                'action'     => 'default',
                // No default id
                'id'         => null,
            ]);

            /**
             * homepage route
             */
            $map->get('homepage', '/')->defaults([
                'controller' => 'index'
            ]);

            /**
             * Cactch all routes
             * @see http://auraphp.com/packages/Aura.Router/other-topics.html#2.7.1
             */
            $map->get('catchall', '{/module,controller,action,id}');
            $map->get('web.catchall', '{/controller,action,id}');

            return $map;
        }
    ),
];
