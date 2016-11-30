<?php

namespace App\Module\Web\Controller;

/**
 * PSR-7 interfaces
 * @see http://www.php-fig.org/psr/psr-7/
 */
use Air\View\ViewFactoryInterface;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Message\ResponseInterface;
use Zend\Diactoros\Response\HtmlResponse;

/**
 * Class ErrorController
 * @package App\Module\Web\Controller
 * @author Petr Pliska <petr.pliska@post.cz>
 */
class ErrorController
{
    /**
     * @var ViewFactoryInterface
     */
    protected $viewFactory;

    /**
     * AbstractWebController constructor.
     * @param ViewFactoryInterface $viewFactory
     */
    public function __construct(ViewFactoryInterface $viewFactory)
    {
        $this->viewFactory = $viewFactory;
    }

    /**
     * @param ServerRequestInterface $request
     * @param ResponseInterface $response
     *
     * @return ResponseInterface
     */
    public function error403Action(ServerRequestInterface $request, ResponseInterface $response)
    {
        return new HtmlResponse((string)$this->viewFactory->get('web/error/403'));
    }

    /**
     * @param ServerRequestInterface $request
     * @param ResponseInterface $response
     *
     * @return ResponseInterface
     */
    public function error404Action(ServerRequestInterface $request, ResponseInterface $response)
    {
        return new HtmlResponse((string)$this->viewFactory->get('web/error/404'));
    }

    /**
     * @param ServerRequestInterface $request
     * @param ResponseInterface $response
     *
     * @return ResponseInterface
     */
    public function error500Action(ServerRequestInterface $request, ResponseInterface $response)
    {
        return new HtmlResponse((string)$this->viewFactory->get('web/error/500'));
    }

    /**
     * @param ServerRequestInterface $request
     * @param ResponseInterface $response
     *
     * @return ResponseInterface
     */
    public function error502Action(ServerRequestInterface $request, ResponseInterface $response)
    {
        return new HtmlResponse((string)$this->viewFactory->get('web/error/502'));
    }

    /**
     * @param ServerRequestInterface $request
     * @param ResponseInterface $response
     *
     * @return ResponseInterface
     */
    public function error503Action(ServerRequestInterface $request, ResponseInterface $response)
    {
        return new HtmlResponse((string)$this->viewFactory->get('web/error/503'));
    }

    /**
     * @param ServerRequestInterface $request
     * @param ResponseInterface $response
     *
     * @return ResponseInterface
     */
    public function error504Action(ServerRequestInterface $request, ResponseInterface $response)
    {
        return new HtmlResponse((string)$this->viewFactory->get('web/error/504'));
    }
}
