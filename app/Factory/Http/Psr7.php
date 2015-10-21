<?php

/**
 * @author Petr Pliska <petr.pliska@post.cz>
 */
namespace App\Factory\Http;

/**
 * Zend diactoros
 */
use Zend\Diactoros\{Response, ServerRequestFactory};

/**
 * PSR-7 interfaces
 */
use Psr\Http\Message\{RequestInterface, ResponseInterface};

/**
 * Interop DI intervace
 * @see https://github.com/container-interop/container-interop
 */
use Interop\Container\ContainerInterface;

class Psr7
{
    /**
     * @param ContainerInterface $c
     * @return RequestInterface
     */
    public function createRequest(ContainerInterface $c): RequestInterface
    {
        return ServerRequestFactory::fromGlobals();
    }

    /**
     * @param ContainerInterface $c
     * @return ResponseInterface
     */
    public function createResponse(ContainerInterface $c): ResponseInterface
    {
        return new Zend\Diactoros\Response;
    }
}
