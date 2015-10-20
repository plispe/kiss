<?php

/**
 * @author Petr Pliska <petr.pliska@post.cz>
 */
namespace App\Module\Api\Controller;

/**
 * PSR-7 interfaces
 * @see http://www.php-fig.org/psr/psr-7/
 */
use Psr\Http\Message\{RequestInterface, ResponseInterface};;

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
use Symfony\Component\HttpKernel\Exception\{NotFoundHttpException, BadRequestHttpException};

class ProjectController extends AbstractApiController
{
    /**
     * @Inject
     * @var DibiConnection
     */
    protected $database;

    /**
     * @param RequestInterface $request
     * @param ResponseInterface $response
     *
     * @return ResponseInterface
     */
    public function findAllAction(RequestInterface $request, ResponseInterface $response)
    {
        $response = new JsonResponse([]);
        return $response;
    }

    /**
     * @param RequestInterface $request
     * @param ResponseInterface $response
     *
     * @return ResponseInterface
     */
    public function findOneAction(RequestInterface $request, ResponseInterface $response)
    {
        // throw new NotFoundHttpException;
        return $response;
    }

    /**
     * @param RequestInterface $request
     * @param ResponseInterface $response
     *
     * @return ResponseInterface
     */
    public function createNewAction(RequestInterface $request, ResponseInterface $response)
    {
        $json = $this->parseJsonRequestBody($request);

        $response = new JsonResponse($json, Response::HTTP_CREATED);
        return $response;
    }

    /**
     * @param RequestInterface $request
     * @param ResponseInterface $response
     *
     * @return ResponseInterface
     */
    public function updateOneAction(RequestInterface $request, ResponseInterface $response)
    {
        $json = $this->parseJsonRequestBody($request);

        $response = new JsonResponse([], Response::HTTP_OK);
        return $response;
    }

    /**
     * @param RequestInterface $request
     * @param ResponseInterface $response
     *
     * @return ResponseInterface
     */
    public function updateOnePartialAction(RequestInterface $request, ResponseInterface $response)
    {
        $response = new JsonResponse([], Response::HTTP_OK);
        return $response;
    }

    /**
     * @param RequestInterface $request
     * @param ResponseInterface $response
     *
     * @return ResponseInterface
     */
    public function deleteOneAction(RequestInterface $request, ResponseInterface $response)
    {
        $id = $request->getAttribute('route')->attributes['id'];

        $response = new JsonResponse(null, Response::HTTP_NO_CONTENT);

        return $response;
    }

    /**
     * @param RequestInterface $request
     * @return string
     *
     * @throws BadRequestHttpException
     */
    protected function parseJsonRequestBody(RequestInterface $request)
    {
        $requestJson = json_decode($request->getBody());

        if ($requestJson === null) {
            throw new BadRequestHttpException('Request body is not a valid JSON.');
        }

        return $requestJson;
    }
}
