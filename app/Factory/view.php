<?php

/**
 * View object factory
 *
 * @author Petr Pliska <petr.pliska@post.cz>
 */
namespace App\Factory;

/**
 * Interop DI intervace
 * @see https://github.com/container-interop/container-interop
 */
use Interop\Container\ContainerInterface;

/**
 * @see https://github.com/zendframework/zend-diactoros
 */
use Zend\Diactoros\Response\HtmlResponse;

/**
 * Form Builder
 * @see https://github.com/adamwathan/form
 */
use AdamWathan\Form\FormBuilder;

/**
 * Psr7 request
 * @see http://www.php-fig.org/psr/psr-7/
 */
use Psr\Http\Message\RequestInterface;

/**
 * @todo Rewrite to anonymous class, but now it is not work on heroku
 */
use App\Library\View;

if (! function_exists('App\Factory\view')) {
    function view(ContainerInterface $c) {
        // Inject dependencies
        return $c->call(function (\Latte\Engine $latte, FormBuilder $builder, RequestInterface $request) use ($c) {
            // Create view object
            $view = new View($c->get('templates.dir'));

            /*
               Register tempalte engines
             */
            $view->registerTemplateEngine('.latte', function (string $template, array $params) use ($latte) {
                // Creates html response with rendered html
                return new HtmlResponse($latte->renderToString($template, $params));
            });

            /*
               Set default variables
             */

            // Html form builder
            $view->builder = $builder;
            // Psr7 request
            $view->request = $request;

            return $view;
        });
    }
}
