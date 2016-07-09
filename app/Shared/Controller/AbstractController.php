<?php

namespace App\Shared\Controller;

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
}
