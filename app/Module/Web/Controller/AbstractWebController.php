<?php

namespace App\Module\Web\Controller;

use App\Library\View;
use App\Shared\Controller\AbstractController;

/**
 * Class AbstractWebController
 * @package App\Module\Web\Controller
 * @author Petr Pliska <petr.pliska@post.cz>
 */
abstract class AbstractWebController extends AbstractController
{
    /**
     * @inject
     * @var View
     */
    protected $view;
}
