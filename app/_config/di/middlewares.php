<?php

/**
 * Defines used middlewares and middleware queue
 *
 * You can define an own middle or use existed one
 * @see https://github.com/oscarotero/psr7-middlewares
 *
 * @author Petr Pliska <petr.pliska@post.cz>
 */

/**
 * Service classes and interfaces
 */
use PhpMiddleware\PhpDebugBar\PhpDebugBarMiddleware;

/**
 * Interop DI intervace
 * @see https://github.com/container-interop/container-interop
 */
use Interop\Container\ContainerInterface;

/**
 * PSR 7 middlewares
 * @see https://github.com/oscarotero/psr7-middlewares
 */
use Psr7Middlewares\Middleware;

return [
    /**
     * Middleware queue which is used for Relay
     *
     */
    'middlewares' => [
        DI\get(\App\Shared\Middleware\ClockworkMiddleware::class),
        Middleware::AuraSession(),
        DI\get(\App\Shared\Middleware\Router::class),
        // DI\factory('App\Factory\phpDebugBar'),
    ]
];
