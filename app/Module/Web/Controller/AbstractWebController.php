<?php

/**
 * @author Petr Pliska <petr.pliska@post.cz>
 */

namespace App\Module\Web\Controller;

use App\Shared\Controller\AbstractController;

abstract class AbstractWebController extends AbstractController
{
    /**
     * Helper for rendering latte templates
     */
    use \App\Shared\Behaviour\Controller\View\LatteTrait;


}
