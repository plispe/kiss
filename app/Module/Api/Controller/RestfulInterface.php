<?php

/**
 * @author Petr Pliska <petr.pliska@post.cz>
 */
namespace App\Module\Api\Controller;

/**
 * PSR-7 interfaces
 * @see http://www.php-fig.org/psr/psr-7/
 */
use Psr\Http\Message\{RequestInterface, ResponseInterface};

/**
 * Symfony http exceptions
 *
 * @see http://symfony.com/doc/current/components/http_kernel/introduction.html
 */
use Symfony\Component\HttpKernel\Exception\BadRequestHttpException;

interface RestfulInterface
{
     /**
     * @param RequestInterface $request
     * @param ResponseInterface $response
     *
     * @return ResponseInterface
     */
    public function findAllAction(RequestInterface $request, ResponseInterface $response): ResponseInterface;

    /**
     * @param RequestInterface $request
     * @param ResponseInterface $response
     *
     * @return ResponseInterface
     */
    public function findOneAction(RequestInterface $request, ResponseInterface $response): ResponseInterface;

    /**
     * @param RequestInterface $request
     * @param ResponseInterface $response
     *
     * @return ResponseInterface
     */
    public function createNewAction(RequestInterface $request, ResponseInterface $response): ResponseInterface;

    /**
     * @param RequestInterface $request
     * @param ResponseInterface $response
     *
     * @return ResponseInterface
     */
    public function updateOneAction(RequestInterface $request, ResponseInterface $response): ResponseInterface;

    /**
     * @param RequestInterface $request
     * @param ResponseInterface $response
     *
     * @return ResponseInterface
     */
    public function updateOnePartialAction(RequestInterface $request, ResponseInterface $response): ResponseInterface;

    /**
     * @param RequestInterface $request
     * @param ResponseInterface $response
     *
     * @return ResponseInterface
     */
    public function deleteOneAction(RequestInterface $request, ResponseInterface $response): ResponseInterface;
}
