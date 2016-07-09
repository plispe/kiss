<?php

namespace App\Module\Api\Controller;

/**
 * PSR-7 interfaces
 * @see http://www.php-fig.org/psr/psr-7/
 */
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;

/**
 * Interface RestfulInterface
 * @package App\Module\Api\Controller
 * @author Petr Pliska <petr.pliska@post.cz>
 */
interface RestfulInterface
{
    /**
     * @param ServerRequestInterface $request
     * @param ResponseInterface $response
     *
     * @return ResponseInterface
     */
    public function findAllAction(ServerRequestInterface $request, ResponseInterface $response): ResponseInterface;

    /**
     * @param ServerRequestInterface $request
     * @param ResponseInterface $response
     *
     * @return ResponseInterface
     */
    public function findOneAction(ServerRequestInterface $request, ResponseInterface $response): ResponseInterface;

    /**
     * @param ServerRequestInterface $request
     * @param ResponseInterface $response
     *
     * @return ResponseInterface
     */
    public function createNewAction(ServerRequestInterface $request, ResponseInterface $response): ResponseInterface;

    /**
     * @param ServerRequestInterface $request
     * @param ResponseInterface $response
     *
     * @return ResponseInterface
     */
    public function updateOneAction(ServerRequestInterface $request, ResponseInterface $response): ResponseInterface;

    /**
     * @param ServerRequestInterface $request
     * @param ResponseInterface $response
     *
     * @return ResponseInterface
     */
    public function updateOnePartialAction(ServerRequestInterface $request, ResponseInterface $response): ResponseInterface;

    /**
     * @param ServerRequestInterface $request
     * @param ResponseInterface $response
     *
     * @return ResponseInterface
     */
    public function deleteOneAction(ServerRequestInterface $request, ResponseInterface $response): ResponseInterface;
}
