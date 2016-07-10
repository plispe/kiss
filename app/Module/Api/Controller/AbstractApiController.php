<?php

namespace App\Module\Api\Controller;

/**
 * PSR-7 interfaces
 * @see http://www.php-fig.org/psr/psr-7/
 */
use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Message\ResponseInterface;

/**
 * Own classes and interfaces
 */
use Symfony\Component\HttpKernel\Exception\BadRequestHttpException;

/**
 * Class AbstractApiController
 * @package App\Module\Api\Controller
 * @author Petr Pliska <petr.pliska@post.cz>
 */
abstract class AbstractApiController
{
    /**
     * @param ServerRequestInterface $request
     * @return ResponseInterface
     * @throws BadRequestHttpException
     */
    protected function parseJsonRequestBody(ServerRequestInterface $request): ResponseInterface
    {
        $requestJson = json_decode($request->getBody());

        if ($requestJson === null) {
            throw new BadRequestHttpException('Request body is not a valid JSON.');
        }

        return $requestJson;
    }
}
