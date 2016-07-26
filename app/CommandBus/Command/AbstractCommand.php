<?php

namespace App\CommandBus\Command;

/**
 * Class AbstractCommand
 * @package App\CommandBus\Command
 */
class AbstractCommand implements CommandInterface
{
    /**
     * @return string
     */
    public function getName()
    {
        return static::class;
    }
}
