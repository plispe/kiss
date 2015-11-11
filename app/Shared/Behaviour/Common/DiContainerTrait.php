<?php

/**
 * @author Petr Pliska <petr.pliska@post.cz>
 */

namespace App\Shared\Behaviour\Common;

use DI\Container;

trait DiContainerTrait
{
    /**
     * @var Container
     */
    protected $diContainer;

    public function setDiContainer(Container $diContainer)
    {
        $this->diContainer = $diContainer;
    }
}