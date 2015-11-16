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

use Aura\Router\Generator;

use function Stringy\create as s;

if (! function_exists('App\Factory\view')) {
    function view(ContainerInterface $c) {
        // Inject dependencies
        return $c->call(function (
                \Latte\Engine $latte,
                // \League\Plates\Engine $plates,
                // \Xiaoler\Blade\Factory $blade,
                // \Twig_Environment $twig,
                FormBuilder $builder,
                RequestInterface $request,
                Generator $urlGenerator
            ) use ($c) {
                // Create view object
                $view = new View($c->get('templates.dir'));
                $templatesDir = $c->get('templates.dir');
                /*
                   Register tempalte engines
                 */

                // Latte
                $view->registerTemplateEngine('.latte', function (string $template, array $params) use ($latte, $templatesDir) {
                    // Creates html response with rendered html
                    return new HtmlResponse($latte->renderToString(sprintf('%s%s', $templatesDir, $template), $params));
                });

                // plates
                // $view->registerTemplateEngine('.php', function (string $template, array $variables) use ($plates) {
                //     $t = s($template);

                //     return new HtmlResponse(
                //         $plates->render(
                //             (string) ($t->startsWith('/') ?  $t->removeLeft('/') : $t)->replace('.php', ''),
                //             $variables
                //         )
                //     );
                // });

                // blade
                // $view->registerTemplateEngine('.blade', function (string $template, array $variables) use ($blade) {
                //     $t = s($template);
                //     return new HtmlResponse(
                //         $blade
                //             ->make(
                //                 (string) ($t->startsWith('/') ?  $t->removeLeft('/') : $t)->replace('.blade', ''),
                //                 $variables)
                //             ->render()
                //     );
                // });

                // twig
                // $view->registerTemplateEngine('.twig', function (string $template, array $variables) use ($twig) {
                //     $template = $twig->loadTemplate($template);

                //     return new HtmlResponse($template->render($variables));
                // });

                /*
                   Set default variables
                 */

                // Html form builder
                $view->builder = $builder;
                // Psr7 request
                $view->request = $request;
                // Url generator
                $view->urlGenerator = $urlGenerator;

            return $view;
        });
    }
}
