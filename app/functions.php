<?php

/**
 * Some helper functions, which can be useful for exception handling
 *
 * @author Petr Pliska <petr.pliska@post.cz>
 */

namespace App;

/**
 * Tracy visualization of errors and exceptions
 * @see https://tracy.nette.org/
 */
use Tracy\BlueScreen;

/**
 * Zend implementation of PSR-7
 * @see https://github.com/zendframework/zend-diactoros
 */
use Zend\Diactoros\Response\JsonResponse;
use Zend\Diactoros\Response\HtmlResponse;
use Zend\Diactoros\Response\EmptyResponse;

/**
 * Symfony exceptions
 * @see http://api.symfony.com/2.7/Symfony/Component/HttpKernel/Exception.html
 */
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Exception\HttpExceptionInterface;

if (! function_exists('App\getStatusCode')) {
    /**
     * @param \Exception
     *
     * @return Int
     */
    function getStatusCode(\Exception $e)
    {
        return $e instanceof HttpExceptionInterface ?
            $e->getStatusCode() : Response::HTTP_INTERNAL_SERVER_ERROR;
    }

}

if (! function_exists('App\exceptionToHtmlResponse')) {
    /**
     * Turns Exception object into PSR-7 HtmlMessage
     * @see http://tracy.nette.org/en/
     *
     * @param \Exception
     *
     * @return HtmlResponse
     */
    function exceptionToHtmlResponse(\Exception $e)
    {
        ob_start();
        $bluescreen = new BlueScreen();
        $bluescreen->render($e);

        $html = ob_get_clean();

        return new HtmlResponse($html, getStatusCode($e));
    }

}

if (! function_exists('App\exceptionToJsonResponse')) {
    /**
     * Turns Exception object into PSR-7 JsonResponse
     * @param \Exception
     *
     * @return JsonResponse
     */
    function exceptionToJsonResponse(\Exception $e)
    {
        $code          = getStatusCode($e);
        $emptyResponse = new EmptyResponse($code);

        return new JsonResponse(
            ['error' => $emptyResponse->getReasonPhrase()],
            $code
        );
    }
}
