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

$handler = new Error\Handler();
$handler->error(function (Exception $e) {
    /**
     * If ENV variable DISPLAY_ERRORS is "true" Tracy is used for exception rendering
     * @see http://tracy.nette.org/en/
     */
    $response = getenv('DISPLAY_ERRORS') === 'true' ?
        App\exceptionToHtmlResponse($e)  :
        App\exceptionToJsonResponse($e);

    /**
     * Emittes PSR-7 message
     */
    $emitter  = new SapiEmitter;
    $emitter->emit($response);
});
