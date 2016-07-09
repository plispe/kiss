<?php

namespace App\Vendor\Bernard\Router;

use Bernard\Router\SimpleRouter;
use Interop\Container\ContainerInterface;

/**
 * Class PhpDiAwareRouter
 * @package App\Vendor\Bernard\Router
 * @author Petr Pliska <petr.pliska@post.cz>
 */
class PhpDiAwareRouter extends SimpleRouter
{
    /**
     * @var ContainerInterface
     */
    protected $container;

    /**
     * PhpDiAwareRouter constructor.
     * @param ContainerInterface $container
     * @param array $receivers
     */
    public function __construct(ContainerInterface $container, array $receivers = [])
    {
        $this->container = $container;

        parent::__construct($receivers);
    }

    /**
     * {@inheritdoc}
     */
    protected function get($name)
    {
        return $this->container->get($name);
    }

    /**
     * {@inheritdoc}
     */
    protected function accepts($receiver)
    {
        return true;
    }

}
