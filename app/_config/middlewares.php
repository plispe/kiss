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
use Relay\RelayBuilder;
use PhpMiddleware\PhpDebugBar\PhpDebugBarMiddleware;
/**
 * Used factories
 */
use App\Factory\Http\Relay;
use App\Factory\Devtool\PhpDebugBar;

/**
 * Interop DI intervace
 * @see https://github.com/container-interop/container-interop
 */
use Interop\Container\ContainerInterface;

return [
    /**
     * Middleware wildcard
     * @see http://php-di.org/doc/php-definitions.html#wildcards
     */
    '\App\Shared\Middleware\*'   => DI\object('App\Shared\Middleware\*'),

    /**
     * Middleware queue which is used for Relay
     *
     */
    'middlewares' => [
        // \Psr7Middlewares\Middleware::ClientIp(),
        DI\get(\App\Shared\Middleware\ClockworkMiddleware::class),
        DI\get(\App\Shared\Middleware\Router::class),
        DI\get(\App\Shared\Middleware\Dispatcher::class),
        DI\factory([PhpDebugBar::class, 'create']),
    ]
];
