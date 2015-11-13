<?php

namespace App\Service\Command\User;

class Register
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
