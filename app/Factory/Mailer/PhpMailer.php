<?php

/**
 * PHPMailer PHP-DI factory
 *
 * @see https://github.com/PHPMailer/PHPMailer
 * @author Petr Pliska <petr.pliska@post.cz>
 */

namespace App\Factory\Mailer;

/**
 * Interop DI intervace
 * @see https://github.com/container-interop/container-interop
 */
use Interop\Container\ContainerInterface;

class PhpMailer
{
    /**
     * @param ContainerInterface $c
     * @return PHPMailer
     */
    public function create(ContainerInterface $c)
    {
        $mail = new PHPMailer;

        return $mail;
    }
}
