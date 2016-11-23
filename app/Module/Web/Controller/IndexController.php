<?php

namespace App\Module\Web\Controller;

/**
 * PSR-7 interfaces
 * @see http://www.php-fig.org/psr/psr-7/
 */
use Air\View\ViewFactoryInterface;
use CCMBenchmark\Ting\Repository\RepositoryFactory;
use Psr\Http\Message\ResponseInterface;
use Zend\Diactoros\Response\HtmlResponse;

/**
 * Class IndexController
 * @package App\Module\Web\Controller
 * @author Petr Pliska <petr.pliska@post.cz>
 */
class IndexController
{
    /**
     * @var ViewFactoryInterface
     */
    protected $viewFactory;

    /**
     * @var RepositoryFactory
     */
    protected $repositoryFactory;

    /**
     * AbstractWebController constructor.
     * @param ViewFactoryInterface $viewFactory
     */
    public function __construct(ViewFactoryInterface $viewFactory, RepositoryFactory $repositoryFactory)
    {
        $this->repositoryFactory = $repositoryFactory;
        $this->viewFactory = $viewFactory;
    }

    /**
     * @return ResponseInterface
     */
    public function defaultAction(): ResponseInterface
    {
        return new HtmlResponse((string)$this->viewFactory->get('web/index/default'));
    }
}
