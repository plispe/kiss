<?php

namespace App\ServiceProvider;

/**
 * Aura.Router
 * @see http://auraphp.com/packages/Aura.Router/
 */
use Aura\Router\Generator;

/**
 * Form builder
 * @see https://github.com/adamwathan/form
 */
use AdamWathan\Form\FormBuilder;

/**
 * Interop DI intervace
 * @see https://github.com/container-interop/container-interop
 */
use Interop\Container\ContainerInterface;

/**
 * Standard service providers
 * @see https://github.com/container-interop/service-provider
 */
use Interop\Container\ServiceProvider;

/**
 * @see https://latte.nette.org/cs/
 */
use Latte\Engine;

/**
 * PSR-7 server interface
 * @see http://www.php-fig.org/psr/psr-7/
 */
use Psr\Http\Message\ServerRequestInterface;

/**
 * Zend diactoros server
 * @see https://zendframework.github.io/zend-diactoros/
 */
use Zend\Diactoros\Response\HtmlResponse;

/**
 * Class View
 * @package App\ServiceProvider
 * @author Petr Pliska <petr.pliska@post.cz>
 */
class View implements ServiceProvider
{

    /**
     * Returns a list of all container entries registered by this service provider.
     *
     * - the key is the entry name
     * - the value is a callable that will return the entry, aka the **factory**
     *
     * Factories have the following signature:
     *        function(ContainerInterface $container, callable $getPrevious = null)
     *
     * About factories parameters:
     *
     * - the container (instance of `Interop\Container\ContainerInterface`)
     * - a callable that returns the previous entry if overriding a previous entry, or `null` if not
     *
     * @return callable[]
     */
    public function getServices()
    {
        return [
            \App\Library\View::class => function (ContainerInterface $container) {
                $view = new \App\Library\View($container->get('templates.dir'));

                // Latte
                $view->registerTemplateEngine('.latte', function (string $template, array $params) use ($container) {
                    $latte = $container->get(Engine::class);
                    return new HtmlResponse($latte->renderToString(sprintf('%s%s', $container->get('templates.dir'), $template), $params));
                });

                // Html form builder
                $view->builder = $container->get(FormBuilder::class);
                // Psr7 request
                $view->request = $container->get(ServerRequestInterface::class);
                // Url generator
                $view->urlGenerator = $container->get(Generator::class);

                return $view;
            }
        ];
    }
}
