<?php

namespace App\Vendor\Codegyre\Robo;

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
 * @package App\Vendor\Codegyre\Robo
 * 
 * @author Petr Pliska <petr.pliska@post.cz>
 */
class Runner extends \Robo\Runner
{
    /**
     *
     */
    use DiContainerTrait;

    /**
     * @param null $input
     * @throws \Exception
     * @return null
     */
    public function execute($input = null)
    {
        register_shutdown_function(array($this, 'shutdown'));
        set_error_handler(array($this, 'handleError'));
        Config::setOutput(new ConsoleOutput());

        $input = $this->prepareInput($input ? $input : $_SERVER['argv']);
        $app = new Application('Robo', self::VERSION);
        $app->setDiContainer($this->diContainer);
        $app->setCatchExceptions(false);

        if (!$this->loadRoboFile()) {
            $this->yell("Robo is not initialized here. Please run `robo init` to create a new RoboFile", 40, 'yellow');
            $app->addInitRoboFileCommand($this->roboFile, $this->roboClass);
            $app->run($input);
            return;
        }
        $app->addCommandsFromClass($this->roboClass, $this->passThroughArgs);
        $app->run($input);
    }
}
