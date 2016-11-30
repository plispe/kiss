<?php

/**
 * Simple error handler
 *
 * @see https://github.com/mrjgreen/error
 * @author Petr Pliska <petr.pliska@post.cz>
 */

$handler = new Error\Handler();
$handler->error(function (\Exception $e) {
    $response = getenv('DISPLAY_ERRORS') === 'true' ?
        // Display tracy bluescreen
        App\exceptionToHtmlResponse($e) :
        // Display error page
        App\renderExceptionTemplateToHtmlResponse($e);

    /*
     * Emittes PSR-7 message
     */
    (new Zend\Diactoros\Response\SapiEmitter)->emit($response);
});
