<?php

namespace App\Shared\Controller;

/**
 * @see http://auraphp.com/packages/Aura.Router/generating-paths.html#2.4
 */
use Aura\Router\Generator;

/**
 * @see  http://tactician.thephpleague.com/
 */
use League\Tactician\CommandBus;

/**
 * Simple abstract controller
 *
 * @author Petr Pliska <petr.pliska@post.cz>
 */
abstract class AbstractController
{
    /**
     * @Inject
     * @var CommandBus
     */
    protected $commandBus;

    /**
     * @Inject
     * @var Generator
     */
    protected $uriGenerator;
}
