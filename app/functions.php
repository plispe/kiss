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
use Zend\Diactoros\Response\HtmlResponse;

/**
 * Symfony exceptions
 * @see http://api.symfony.com/2.7/Symfony/Component/HttpKernel/Exception.html
 */
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Exception\HttpExceptionInterface;

/**
 * Html form builder
 * @see https://github.com/adamwathan/form
 */
use AdamWathan\Form\FormBuilder;

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
    (new BlueScreen())->render($e);

    return new HtmlResponse(ob_get_clean(), getStatusCode($e));
}

/**
 * Turns Exception object into PSR-7 HtmlMessage
 * @see https://latte.nette.org/en/
 *
 * @param \Exception
 *
 * @return HtmlResponse
 */
function renderExceptionTemplateToHtmlResponse(\Exception $e)
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
