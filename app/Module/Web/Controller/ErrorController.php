<?php

/**
 * @author Petr Pliska <petr.pliska@post.cz>
 */

namespace App\Module\Web\Controller;

/**
 * PSR-7 interfaces
 * @see http://www.php-fig.org/psr/psr-7/
 */
use Psr\Http\Message\{RequestInterface, ResponseInterface};

class ErrorController extends AbstractWebController
{
    /**
     * @param RequestInterface $request
     * @param ResponseInterface $reseponse
     *
     * @return RequestInterface
     */
    public function error403Action(RequestInterface $request, ResponseInterface $response): ResponseInterface
    {
        return $this->view->render('web/error/403.latte');
    }

    /**
     * @param RequestInterface $request
     * @param ResponseInterface $reseponse
     *
     * @return RequestInterface
     */
    public function error404Action(RequestInterface $request, ResponseInterface $response): ResponseInterface
    {
        return $this->view->render('web/error/404.latte');

    }

    /**
     * @param RequestInterface $request
     * @param ResponseInterface $reseponse
     *
     * @return RequestInterface
     */
    public function error500Action(RequestInterface $request, ResponseInterface $response): ResponseInterface
    {
        return $this->view->render('web/error/500.latte');
    }

    /**
     * @param RequestInterface $request
     * @param ResponseInterface $reseponse
     *
     * @return RequestInterface
     */
    public function error502Action(RequestInterface $request, ResponseInterface $response): ResponseInterface
    {
        return $this->view->render('web/error/502.latte');
    }

    /**
     * @param RequestInterface $request
     * @param ResponseInterface $reseponse
     *
     * @return RequestInterface
     */
    public function error503Action(RequestInterface $request, ResponseInterface $response): ResponseInterface
    {
        return $this->view->render('web/error/503.latte');
    }

    /**
     * @param RequestInterface $request
     * @param ResponseInterface $reseponse
     *
     * @return RequestInterface
     */
    public function error504Action(RequestInterface $request, ResponseInterface $response): ResponseInterface
    {
        return $this->view->render('web/error/504.latte');
    }
}
