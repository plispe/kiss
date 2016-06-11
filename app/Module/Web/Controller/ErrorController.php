<?php

namespace App\Module\Web\Controller;

/**
 * PSR-7 interfaces
 * @see http://www.php-fig.org/psr/psr-7/
 */
use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Message\ResponseInterface;

/**
 * Class ErrorController
 * @package App\Module\Web\Controller
 * @author Petr Pliska <petr.pliska@post.cz>
 */
class ErrorController extends AbstractWebController
{
    /**
     * @param ServerRequestInterface $request
     * @param ResponseInterface $response
     *
     * @return ResponseInterface
     */
    public function error403Action(ServerRequestInterface $request, ResponseInterface $response): ResponseInterface
    {
        return $this->view->render('web/error/403.latte');
    }

    /**
     * @param ServerRequestInterface $request
     * @param ResponseInterface $response
     *
     * @return ResponseInterface
     */
    public function error404Action(ServerRequestInterface $request, ResponseInterface $response): ResponseInterface
    {
        return $this->view->render('web/error/404.latte');
    }

    /**
     * @param ServerRequestInterface $request
     * @param ResponseInterface $response
     *
     * @return ResponseInterface
     */
    public function error500Action(ServerRequestInterface $request, ResponseInterface $response): ResponseInterface
    {
        return $this->view->render('web/error/500.latte');
    }

    /**
     * @param ServerRequestInterface $request
     * @param ResponseInterface $response
     *
     * @return ResponseInterface
     */
    public function error502Action(ServerRequestInterface $request, ResponseInterface $response): ResponseInterface
    {
        return $this->view->render('web/error/502.latte');
    }

    /**
     * @param ServerRequestInterface $request
     * @param ResponseInterface $response
     *
     * @return ResponseInterface
     */
    public function error503Action(ServerRequestInterface $request, ResponseInterface $response): ResponseInterface
    {
        return $this->view->render('web/error/503.latte');
    }

    /**
     * @param ServerRequestInterface $request
     * @param ResponseInterface $response
     *
     * @return ResponseInterface
     */
    public function error504Action(ServerRequestInterface $request, ResponseInterface $response): ResponseInterface
    {
        return $this->view->render('web/error/504.latte');
    }
}
