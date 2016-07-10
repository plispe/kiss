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
 * Middleware queue which is used for Relay
 */
return [
    'middlewares' => [
        \PSR7Session\Http\SessionMiddleware::fromSymmetricKeyDefaults(
            getenv('SESSION_KEY') ?: 'session-key',
            getenv('SESSION_EXPIRATION_TIME') ?: 1440
        ),
        DI\get(\App\Shared\Middleware\Router::class),
    ]
];
