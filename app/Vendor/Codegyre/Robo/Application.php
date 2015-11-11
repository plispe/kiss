<?php

/**
 * @author Petr Pliska <petr.pliska@post.cz>
 */
namespace App\Vendor\Codegyre\Robo;

/**
 *
 */
use Robo\Result;
use Robo\TaskInfo;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;

/**
 * Own classes
 */
use App\Shared\Behaviour\Common\DiContainerTrait;

class Application extends \Robo\Application
{
    /**
     * Trait for loading container
     */
    use DiContainerTrait;

    /**
     * @param $className
     * @param null $passThrough
     * @throws \DI\NotFoundException
     */
    public function addCommandsFromClass($className, $passThrough = null)
    {
        $roboTasks = $this->diContainer->get($className);
        $this->diContainer->injectOn($roboTasks);

        $commandNames = array_filter(get_class_methods($className), function($m) {
            return !in_array($m, ['__construct']);
        });

        foreach ($commandNames as $commandName) {
            $command = $this->createCommand(new TaskInfo($className, $commandName));
            $command->setCode(function(InputInterface $input) use ($roboTasks, $commandName, $passThrough) {
                // get passthru args
                $args = $input->getArguments();
                array_shift($args);
                if ($passThrough) {
                    $args[key(array_slice($args, -1, 1, TRUE))] = $passThrough;
                }
                $args[] = $input->getOptions();

                $res = call_user_func_array([$roboTasks, $commandName], $args);
                if (is_int($res)) exit($res);
                if (is_bool($res)) exit($res ? 0 : 1);
                if ($res instanceof Result) exit($res->getExitCode());
            });
            $this->add($command);
        }
    }
}