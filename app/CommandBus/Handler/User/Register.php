<?php

namespace App\CommandBus\Handler\User;

use App\CommandBus\Command\User\Register as RegisterCommand;

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
