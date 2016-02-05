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
 * Own classes and interfaces
 */
use App\Shared\Controller\AbstractController;

abstract class AbstractApiController extends AbstractController
{
     /**
     * @param RequestInterface $request
     * @return ResponseInterface
     * @throws BadRequestHttpException
     */
    protected function parseJsonRequestBody(RequestInterface $request): ResponseInterface
    {
        $requestJson = json_decode($request->getBody());

        if ($requestJson === null) {
            throw new BadRequestHttpException('Request body is not a valid JSON.');
        }

        return $requestJson;
    }
}
