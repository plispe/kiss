<?php

/**
 * PHPMailer PHP-DI factory
 *
 * @see https://github.com/PHPMailer/PHPMailer
 * @author Petr Pliska <petr.pliska@post.cz>
 */

namespace App\Factory;

/**
 * Interop DI intervace
 * @see https://github.com/container-interop/container-interop
 */
use Interop\Container\ContainerInterface;

if (! function_exists('App\Factory\phpMailer')) {
    /**
     * @param ContainerInterface $c
     * @return PHPMailer
     */
    function phpMailer(ContainerInterface $c)
    {
        $mail = new \PHPMailer;

        return $mail;
    }
}
