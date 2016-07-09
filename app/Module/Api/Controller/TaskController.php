<?php

/**
 * @author Petr Pliska <petr.pliska@post.cz>
 */
namespace App\Module\Api\Controller;

/**
 * PSR-7 interfaces
 * @see http://www.php-fig.org/psr/psr-7/
 */
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;

/**
 * Zend diactoros server
 *
 * @see https://github.com/zendframework/zend-diactoros
 */
use Zend\Diactoros\Response\JsonResponse;

class TaskController extends AbstractApiController
{
    /**
     * @param ServerRequestInterface $request
     * @param ResponseInterface $response
     *
     * @return ResponseInterface
     */
    public function findAllAction(ServerRequestInterface $request, ResponseInterface $response): ResponseInterface
    {
        $response = new JsonResponse([]);
        return $response;
    }

    /**
     * @param ServerRequestInterface $request
     * @param ResponseInterface $response
     * @return ResponseInterface
     */
    public function findOneAction(ServerRequestInterface $request, ResponseInterface $response): ResponseInterface
    {
        $response = new JsonResponse([]);
        return $response;
    }
}
