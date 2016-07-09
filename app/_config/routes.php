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
    'module' => 'web',
    // No default controller
    'controller' => null,
    // Default action id "default"
    'action' => 'default',
    // No default id
    'id' => null,
]);

// /api
$map->attach('api.', '/api', function ($map) {
    $map->defaults([
        'module' => 'api',
    ]);

    // /api/projects
    // Project resource
    $map->attach('projects.', '/projects', function ($map) {
        $map->defaults(['controller' => 'project']);
        // actions
        $map->get('findAll', '')->defaults(['action' => 'findAll']);
        $map->get('findOne', '/{projectId}')->defaults(['action' => 'findOne']);
        $map->put('update', '/{projectId}')->defaults(['action' => 'updateOne']);
        $map->patch('partialUpdate', '/{projectId}')->defaults(['action' => 'updateOnePartial']);
        $map->post('create', '')->defaults(['action' => 'createNew']);
        $map->delete('delete', '/{projectId}')->defaults(['action' => 'deleteOne']);

        // /api/projects/<projectId>/tasks
        $map->attach('tasks.', '/{projectId}/tasks', function ($map) {
            // Sub resources
            $map->defaults(['controller' => 'task']);

            $map->get('findAll', '')->defaults(['action' => 'findAll']);
            $map->get('findOne', '/{taskId}')->defaults(['action' => 'findOne']);
            $map->put('update', '/{taskId}')->defaults(['action' => 'updateOne']);
            $map->patch('partialUpdate', '/{taskId}')->defaults(['action' => 'updateOnePartial']);
            $map->post('create', '')->defaults(['action' => 'createNew']);
            $map->delete('delete', '/{taskId}')->defaults(['action' => 'deleteOne']);
        });
    });

    $map->attach('tasks.', '/tasks', function ($map) {
        $map->defaults(['controller' => 'task']);

        // actions
        $map->get('findAll', '')->defaults(['action' => 'findAll']);
        $map->get('findOne', '/{taskId}')->defaults(['action' => 'findOne']);
        $map->put('update', '/{taskId}')->defaults(['action' => 'updateOne']);
        $map->patch('partialUpdate', '/{taskId}')->defaults(['action' => 'updateOnePartial']);
        $map->post('create', '')->defaults(['action' => 'createNew']);
        $map->delete('delete', '/{taskId}')->defaults(['action' => 'deleteOne']);
    });

});

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
