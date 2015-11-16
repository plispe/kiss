<?php

/**
 * @author Petr Pliska <petr.pliska@post.cz>
 */
namespace App\Factory;

/**
 * Interop DI intervace
 * @see https://github.com/container-interop/container-interop
 */
use Interop\Container\ContainerInterface;

/**
 * Aura.Router classes
 * @see http://auraphp.com/packages/Aura.Router/
 */
use Aura\Router\{Generator, RouterContainer};

use Psr\Http\Message\{UriInterface, RequestInterface};

if (! function_exists('App\Factory\auraUrlGenerator'))
{
    /**
     * @param ContainerInterface $c)
     * @return Generator
     */
    function auraUrlGenerator(ContainerInterface $c)
    {
        return $c->call(function (RouterContainer $container, RequestInterface $request) {
            return new class($container, $request) extends Generator {
                /**
                 * @var UriInterface
                 */
                protected $uri;

                /**
                 * @param Generator
                 * @param RequestInterface
                 */
                public function __construct(RouterContainer $container, RequestInterface $request)
                {
                    $this->uri = $request->getUri();
                    parent::__construct($container->getMap());
                }

                /**
                 * @param  string
                 * @param  array
                 * @return UriInterface
                 */
                public function generate($name, $data = []): UriInterface
                {
                    return $this->uri->withPath(parent::generate($name, $data));
                }

                /**
                 * @param  string
                 * @param  array
                 * @return UriInterface
                 */
                public function generateRaw($name, $data = []): UriInterface
                {
                    return $this->uri->withPath(parent::generateRaw($name, $data));
                }
            };
        });
    }
}
