<?php

namespace App\Module\Web\Controller;

/**
 * PSR-7 interfaces
 * @see http://www.php-fig.org/psr/psr-7/
 */
use Air\View\ViewFactoryInterface;
use App\Model\Repository\City;
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
        /** @var \App\Model\Repository\City $r */
        $r = $this->repositoryFactory->get(City::class);

        /** @var \App\Model\Entity\City $brno */
        $brno = $r->get(['cit_id' => 4084]);
        $brno->setPopulation(450000);
        $brno->setDistrict("Jihomoravsky");
        $r->save($brno);

        return new HtmlResponse((string)$this->viewFactory->get('web/index/default'));
    }
}
