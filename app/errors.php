<?php

/**
 * Simple error handler
 *
 * @see https://github.com/mrjgreen/error
 * @author Petr Pliska <petr.pliska@post.cz>
 */

/**
 * Zend implementation of PSR-7
 * @see https://github.com/zendframework/zend-diactoros
 */
use Zend\Diactoros\Response\SapiEmitter;

/**
 * Stringy
 * @see https://github.com/danielstjules/Stringy
 */
use function Stringy\create as s;

$handler = new Error\Handler();
$handler->error(function (\Throwable $e) {

    if (getenv('DISPLAY_ERRORS') === 'true') {
        // Display tracy bluescreen
        $response = App\exceptionToHtmlResponse($e);
    } else {
        // Check if api module is used
        $isApiModule = s($_SERVER['REQUEST_URI'])->startsWith('/api/');

        // If api is used response is rendered to JSON, otherwise HTML
        $response = $isApiModule ?
            App\exceptionToJsonResponse($e) : App\renderExceptionTemplateToHtmlResponse($e);
    }

    /**
     * Emittes PSR-7 message
     */
    (new SapiEmitter)->emit($response);
});
