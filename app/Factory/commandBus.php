<?php

/**
 * Tactician command bus factory
 *
 * @see http://tactician.thephpleague.com/
 * @author Petr Pliska <petr.pliska@post.cz>
 */
namespace App\Factory;

/**
 * Interop DI intervace
 * @see https://github.com/container-interop/container-interop
 */
use Interop\Container\ContainerInterface;

use League\Tactician\CommandBus;
use League\Tactician\Handler\Locator\CallableLocator;
use League\Tactician\Handler\CommandHandlerMiddleware;
use League\Tactician\Handler\MethodNameInflector\InvokeInflector;
use League\Tactician\Handler\CommandNameExtractor\ClassNameExtractor;

if (! function_exists('App\Factory\commandBus')) {
    function commandBus(ContainerInterface $c) {
        return new CommandBus([
            new CommandHandlerMiddleware(
                new ClassNameExtractor,
                new CallableLocator(function($command)  use ($c) {
                    return $c->get(str_replace("\\Command\\", "\\CommandHandler\\", $command));
                }),
                new InvokeInflector
            )
        ]);
    }
}
