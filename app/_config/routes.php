<?php

/**
 * @author Petr Pliska <petr.pliska@post.cz>
 */

/**
 * Default settings
 * @see http://auraphp.com/packages/Aura.Router/defining-routes.html#2.2.1
 */
$map->tokens([
    // Allowed module prefixes are admin and api
    'module' => 'admin'
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

$map->resource('project');

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
$map->route('catchall', '{/module,controller,action,id}');
$map->route('web.catchall', '{/controller,action,id}');
