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
     * @Inject
     * @var ViewFactoryInterface
     */
    protected $viewFactory;
}
