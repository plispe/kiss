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
 * PSR 7 middlewares
 * @see https://github.com/oscarotero/psr7-middlewares
 */
use Psr7Middlewares\Middleware;

/**
 * PSR 7 storage-less session
 * @see https://github.com/Ocramius/PSR7Session
 */
use PSR7Session\Http\SessionMiddleware;

return [
    /**
     * Middleware queue which is used for Relay
     *
     */
    'middlewares' => [
        SessionMiddleware::fromSymmetricKeyDefaults(
            getenv('SESSION_KEY') ?: 'session-key',
            getenv('SESSION_EXPIRATION_TIME') ?: 1440
        ),
        DI\get(\App\Shared\Middleware\Router::class),
    ]
];
