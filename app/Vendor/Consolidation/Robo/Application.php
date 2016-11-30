<?php

namespace App\Vendor\Consolidation\Robo;

/**
 * Robo task runner
 *
 * @see http://robo.li/
 */
use Robo\Result;
use Robo\TaskInfo;

/**
 * Command Bus implementation
 *
 * @see http://tactician.thephpleague.com/
 */
use League\Tactician\CommandBus;

/**
 * Symfony console library
 *
 * @see http://symfony.com/doc/current/components/console/introduction.html
 */
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;

/**
 * Own classes
 */
use App\CommandBus\Command\CommandInterface;
use App\Shared\Behaviour\Common\DiContainerTrait;

/**
 * Class Application
 * @package App\Vendor\Consolidation\Robo
 * @author Petr Pliska <petr.pliska@post.cz>
 */
class Application extends \Robo\Application
{
    /**
     * Trait for loading container
     */
    use DiContainerTrait;
}
