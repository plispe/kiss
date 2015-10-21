<?php

/**
 * @author Petr Pliska <petr.pliska@post.cz>
 */
namespace App\Factory;

/**
 * Zend diactoros
 */
use Zend\Diactoros\ServerRequestFactory;

/**
 * PSR-7 interfaces
 */
use Psr\Http\Message\RequestInterface;

/**
 * Interop DI intervace
 * @see https://github.com/container-interop/container-interop
 */
use Interop\Container\ContainerInterface;

if (! function_exists('App\Factory\request'))
{
    /**
     * @param ContainerInterface $c
     * @return RequestInterface
     */
    function request(ContainerInterface $c): RequestInterface
    {
        return ServerRequestFactory::fromGlobals();
    }
}
