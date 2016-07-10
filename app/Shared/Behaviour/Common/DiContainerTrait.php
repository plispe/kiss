<?php

namespace App\Shared\Behaviour\Common;

use DI\Container;

/**
 * Class DiContainerTrait
 * @package App\Shared\Behaviour\Common
 *
 * @author Petr Pliska <petr.pliska@post.cz>
 */
trait DiContainerTrait
{
    /**
     * @var Container
     */
    protected $diContainer;

    /**
     * @param Container $diContainer
     */
    public function setDiContainer(Container $diContainer)
    {
        $this->diContainer = $diContainer;
    }
}
