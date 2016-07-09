<?php

namespace App\Module\Web\Controller;

use Air\View\ViewFactoryInterface;
use App\Shared\Controller\AbstractController;

/**
 * Class AbstractWebController
 * @package App\Module\Web\Controller
 * @author Petr Pliska <petr.pliska@post.cz>
 */
abstract class AbstractWebController extends AbstractController
{
    /**
     * @Inject
     * @var ViewFactoryInterface
     */
    protected $viewFactory;
}
