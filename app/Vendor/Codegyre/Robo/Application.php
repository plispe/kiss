<?php

namespace App\Vendor\Codegyre\Robo;

/**
 * Foreign classes and interfaces
 */

/**
 * @see http://robo.li/
 */
use Robo\Result;
use Robo\TaskInfo;

/**
 * @see http://tactician.thephpleague.com/
 */
use League\Tactician\CommandBus;

/**
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
 * @package App\Vendor\Codegyre\Robo
 * @author Petr Pliska <petr.pliska@post.cz>
 */
class Application extends \Robo\Application
{
    /**
     * Trait for loading container
     */
    use DiContainerTrait;

    /**
     * Adds commands from RoboFile class
     *
     * @param string $className
     * @param null $passThrough
     */
    public function addCommandsFromClass($className, $passThrough = null)
    {
        // Get RoboFile class from di
        $roboTasks = $this->diContainer->get($className);

        // get command names
        $commandNames = array_filter(get_class_methods($className), function ($m) {
            return !in_array($m, ['__construct']);
        });

        // Iteration over commands
        foreach ($commandNames as $commandName) {
            $command = $this->createCommand(new TaskInfo($className, $commandName));
            $command->setCode(function (InputInterface $input) use ($roboTasks, $commandName, $passThrough) {
                // get passthru args
                $args = $input->getArguments();
                array_shift($args);
                if ($passThrough) {
                    $args[key(array_slice($args, -1, 1, true))] = $passThrough;
                }
                $args[] = $input->getOptions();

                // run command method
                $res = call_user_func_array([$roboTasks, $commandName], $args);

                // Handle command Result
                if ($res instanceof CommandInterface) {
                    // get command bus
                    $commandBus = $this->diContainer->get(CommandBus::class);
                    // run command and return command result
                    $res = $commandBus->handle($res);
                }

                // Handle status
                if (is_int($res)) {
                    $res = $res;
                } else if (is_bool($res)) {
                    $res = (int)!$res;
                } else if ($res instanceof Result) {
                    $res = $res->getExitCode();
                }

                // exit script with status
                exit($res);
            });
            $this->add($command);
        }
    }
}
