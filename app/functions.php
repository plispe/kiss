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
 * Latte tamplating engine
 * @see https://latte.nette.org/en/
 */
use \Latte\Engine;

/**
 * Zend implementation of PSR-7
 * @see https://github.com/zendframework/zend-diactoros
 */
use Zend\Diactoros\ServerRequestFactory;
use Zend\Diactoros\Response\{JsonResponse, HtmlResponse, EmptyResponse};

/**
 * Symfony exceptions
 * @see http://api.symfony.com/2.7/Symfony/Component/HttpKernel/Exception.html
 */
use Symfony\Component\{
    HttpFoundation\Response,
    HttpKernel\Exception\HttpExceptionInterface
};

use AdamWathan\Form\FormBuilder;

if (! function_exists('App\getStatusCode')) {
    /**
     * @param \Exception
     *
     * @return Int
     */
    function getStatusCode(\Throwable $e): int
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
    function exceptionToHtmlResponse(\Throwable $e): HtmlResponse
    {
        ob_start();
        (new BlueScreen())->render($e);

        return new HtmlResponse(ob_get_clean(), getStatusCode($e));
    }
}

if (! function_exists('App\exceptionToJsonResponse')) {
    /**
     * Turns Exception object into PSR-7 JsonResponse
     * @param \Exception
     *
     * @return JsonResponse
     */
    function exceptionToJsonResponse(\Throwable $e): JsonResponse
    {
        $code          = getStatusCode($e);

        return new JsonResponse(
            ['error' => (new EmptyResponse($code))->getReasonPhrase()],
            $code
        );
    }
}

if (! function_exists('App\renderExceptionTemplateToHtmlResponse')) {
    /**
     * Turns Exception object into PSR-7 HtmlMessage
     * @see https://latte.nette.org/en/
     *
     * @param \Exception
     *
     * @return HtmlResponse
     */
    function renderExceptionTemplateToHtmlResponse(\Throwable $e): HtmlResponse
    {
        $code = getStatusCode($e);
        $template = sprintf(__DIR__ . '/_templates/web/error/%s.latte', getStatusCode($e));

        // If specific template does not exist, template for error 500 will be rendered.
        if (!file_exists($template)) {
            $template = __DIR__ . '/_templates/web/error/500.latte';
            $code = Response::HTTP_INTERNAL_SERVER_ERROR;
        }

        $params = [
            'request' => ServerRequestFactory::fromGlobals(),
            'builder' => new FormBuilder
        ];

        return new HtmlResponse(
            (new Engine)->renderToString($template, $params),
            $code
        );
    }
}
