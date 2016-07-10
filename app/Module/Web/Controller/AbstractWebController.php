<?php

namespace App\Module\Web\Controller;

use Air\View\ViewFactoryInterface;

/**
 * Class AbstractWebController
 * @package App\Module\Web\Controller
 * @author Petr Pliska <petr.pliska@post.cz>
 */
abstract class AbstractWebController
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
}
