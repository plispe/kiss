<?php

namespace App\CommandBus\Command\User;

use App\CommandBus\Command\CommandInterface;

class Register implements CommandInterface
{
    /**
     * @var string
     */
    protected $emailAddress;

    /**
     * @var string
     */
    protected $password;

    /**
     * @param string $emailAddress
     * @param string $password
     */
    public function __construct(string $emailAddress, string $password)
    {
        $this->emailAddress = $emailAddress;
        $this->password     = $password;
    }

    /**
     * @return string
     */
    public function getEmailAddress(): string
    {
        return $this->emailAddress;
    }
}
