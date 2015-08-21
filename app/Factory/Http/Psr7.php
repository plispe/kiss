<?php

/**
 * @author Petr Pliska <petr.pliska@post.cz>
 */
namespace App\Factory\Http;

/**
 * Zend diactoros
 */
use Zend\Diactoros\Response;
use Zend\Diactoros\ServerRequestFactory;

/**
 * PSR-7 interfaces
 */
use Psr\Http\Message\RequestInterface;
use Psr\Http\Message\ResponseInterface;

use Interop\Container\ContainerInterface;

class Psr7
{
    /**
     * @param ContainerInterface $c
     * @return RequestInterface
     */
    public function createRequest(ContainerInterface $c)
    {
        return ServerRequestFactory::fromGlobals();
    }

    /**
     * @param ContainerInterface $c
     * @return ResponseInterface
     */
    public function createResponse(ContainerInterface $c)
    {
        return new Zend\Diactoros\Response;
    }
}
