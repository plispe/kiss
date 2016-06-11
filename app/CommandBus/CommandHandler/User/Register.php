<?php

namespace App\CommandBus\CommandHandler\User;

use App\CommandBus\Command\User\Register as RegisterCommand;

/**
 * Class Register
 * @package App\CommandBus\CommandHandler\User
 * @author Petr Pliska <petr.pliska@post.cz>
 */
class Register
{
    /**
     * @param RegisterCommand $command
     * @return bool
     */
    public function __invoke(RegisterCommand $command):bool
    {
        // Do your core application logic here. Don't actually echo stuff. :)
        echo "User {$command->getEmailAddress()} was registered!\n";

        return true;
    }
}
