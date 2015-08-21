<?php

/**
 * @author Petr Pliska <petr.pliska@post.cz>
 */

/**
 * Used factories
 */
use App\Factory\Mailer\SwiftMailer;
use App\Factory\Mailer\PhpMailer;

/**
 * Interop DI intervace
 * @see https://github.com/container-interop/container-interop
 */
use Interop\Container\ContainerInterface;

return [
    /**
    * Swift mailer
    * @see http://swiftmailer.org
    */
    Swift_Mailer::class =>function (ContainerInterface $c) {
        return (new SwiftMailer)->create($c);
    },

    /**
     * Php mailer
     * @see https://github.com/PHPMailer/PHPMailer
     */
    PHPMailer::class => function (ContainerInterface $c) {
        return (new PhpMailer)->create($c);
    }
];
