<?php

namespace App\Vendor\Consolidation\Robo;

/**
 * Robo task runner
 *
 * @see http://robo.li
 */
use Robo\Config;

/**
 * Symfony console library
 *
 * @see http://symfony.com/doc/current/components/console/introduction.html
 */
use Symfony\Component\Console\Input\ArgvInput;
use Symfony\Component\Console\Output\ConsoleOutput;

/**
 * Own classes
 */
use App\Shared\Behaviour\Common\DiContainerTrait;

/**
 * Class Runner
 * @package App\Vendor\Consolidation\Robo
 *
 * @author Petr Pliska <petr.pliska@post.cz>
 */
class Runner extends \Robo\Runner
{
    use DiContainerTrait;
}
