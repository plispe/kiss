<?php

namespace App\ServiceProvider;

/**
 * Interop DI intervace
 * @see https://github.com/container-interop/container-interop
 */
use Air\View\ViewFactoryInterface;
use App\Vendor\Air\View\Latte\ViewFactory;
use Interop\Container\ContainerInterface;

/**
 * Standard service providers
 * @see https://github.com/container-interop/service-provider
 */
use Interop\Container\ServiceProvider;

use AdamWathan\Form\FormBuilder;
use Aura\Router\Generator;
use Psr\Http\Message\ServerRequestInterface;

/**
 * Class Latte
 * @package App\ServiceProvider
 * @author Petr Pliska <petr.pliska@post.cz>
 */
class Latte implements ServiceProvider
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
            ViewFactoryInterface::class => $this->getViewFactory(),
        ];
    }

    /**
     * @return \Closure
     */
    protected function getViewFactory()
    {
        return function (ContainerInterface $container) {
            $factory = new ViewFactory($container->get('temp.dir') . '/latte', null, $this->getDefaultLatteData($container));
            $factory->addPath($container->get('templates.dir'));

            return $factory;
        };
    }

    /**
     * @param ContainerInterface $container
     * @return array
     */
    protected function getDefaultLatteData(ContainerInterface $container)
    {
        return [
            'builder' => $container->get(FormBuilder::class),
            // Psr7 request
            'request' => $container->get(ServerRequestInterface::class),
            // Url generator
            'urlGenerator' => $container->get(Generator::class)
        ];
    }
}
