<?php

/**
 * @author Petr Pliska <petr.pliska@post.cz>
 */

namespace App\Module\Web\Controller;

/**
 * PSR-7 interfaces
 * @see http://www.php-fig.org/psr/psr-7/
 */
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\RequestInterface;

class ErrorController extends AbstractWebController
{
    /**
     * @param RequestInterface $request
     * @param ResponseInterface $reseponse
     *
     * @return RequestInterface
     */
    public function error403Action(RequestInterface $request, ResponseInterface $response)
    {
        return $this->renderLatte('web/error/403', ['request' => $request]);
    }

    /**
     * @param RequestInterface $request
     * @param ResponseInterface $reseponse
     *
     * @return RequestInterface
     */
    public function error404Action(RequestInterface $request, ResponseInterface $response)
    {
        return $this->renderLatte('web/error/404', ['request' => $request]);

    }

    /**
     * @param RequestInterface $request
     * @param ResponseInterface $reseponse
     *
     * @return RequestInterface
     */
    public function error500Action(RequestInterface $request, ResponseInterface $response)
    {
        return $this->renderLatte('web/error/500', ['request' => $request]);
    }

    /**
     * @param RequestInterface $request
     * @param ResponseInterface $reseponse
     *
     * @return RequestInterface
     */
    public function error502Action(RequestInterface $request, ResponseInterface $response)
    {
        return $this->renderLatte('web/error/502', ['request' => $request]);
    }

    /**
     * @param RequestInterface $request
     * @param ResponseInterface $reseponse
     *
     * @return RequestInterface
     */
    public function error503Action(RequestInterface $request, ResponseInterface $response)
    {
        return $this->renderLatte('web/error/503', ['request' => $request]);
    }

    /**
     * @param RequestInterface $request
     * @param ResponseInterface $reseponse
     *
     * @return RequestInterface
     */
    public function error504Action(RequestInterface $request, ResponseInterface $response)
    {
        return $this->renderLatte('web/error/504', ['request' => $request]);
    }
}
