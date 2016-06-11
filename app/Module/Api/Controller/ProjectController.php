<?php

namespace App\Module\Api\Controller;

/**
 * PSR-7 interfaces
 * @see http://www.php-fig.org/psr/psr-7/
 */
use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Message\ResponseInterface;

/**
 * Zend diactoros server
 *
 * @see https://github.com/zendframework/zend-diactoros
 */
use Zend\Diactoros\Response\JsonResponse;

/**
 * Symfony http exceptions
 *
 * @see http://symfony.com/doc/current/components/http_kernel/introduction.html
 */
use Symfony\Component\HttpFoundation\Response;

/**
 * Class ProjectController
 * @package App\Module\Api\Controller
 * @author Petr Pliska <petr.pliska@post.cz>
 */
class ProjectController extends AbstractApiController implements RestfulInterface
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
     *
     * @return ResponseInterface
     */
    public function findOneAction(ServerRequestInterface $request, ResponseInterface $response): ResponseInterface
    {
        // throw new NotFoundHttpException;
        return $response;
    }

    /**
     * @param ServerRequestInterface $request
     * @param ResponseInterface $response
     *
     * @return ResponseInterface
     */
    public function createNewAction(ServerRequestInterface $request, ResponseInterface $response): ResponseInterface
    {
        $json = $this->parseJsonRequestBody($request);

        $response = new JsonResponse($json, Response::HTTP_CREATED);
        return $response;
    }

    /**
     * @param ServerRequestInterface $request
     * @param ResponseInterface $response
     *
     * @return ResponseInterface
     */
    public function updateOneAction(ServerRequestInterface $request, ResponseInterface $response): ResponseInterface
    {
        $json = $this->parseJsonRequestBody($request);

        $response = new JsonResponse([], Response::HTTP_OK);
        return $response;
    }

    /**
     * @param ServerRequestInterface $request
     * @param ResponseInterface $response
     *
     * @return ResponseInterface
     */
    public function updateOnePartialAction(ServerRequestInterface $request, ResponseInterface $response): ResponseInterface
    {
        $response = new JsonResponse([], Response::HTTP_OK);
        return $response;
    }

    /**
     * @param ServerRequestInterface $request
     * @param ResponseInterface $response
     *
     * @return ResponseInterface
     */
    public function deleteOneAction(ServerRequestInterface $request, ResponseInterface $response): ResponseInterface
    {
        $id = $request->getAttribute('route')->attributes['id'];

        $response = new JsonResponse(null, Response::HTTP_NO_CONTENT);

        return $response;
    }
}
