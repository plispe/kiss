<?php

/**
 * Swift mailer PHP-DI factory
 *
 * @see http://swiftmailer.org/
 * @author Petr Pliska <petr.pliska@post.cz>
 */

namespace App\Factory;

/**
 * Interop DI intervace
 * @see https://github.com/container-interop/container-interop
 */
use Interop\Container\ContainerInterface;

if (! function_exists('App\Factory\swiftMailer'))
{
    /**
     * @param ContainerInterface $c
     * @return Swift_Mailer
     */
    function swiftMailer(ContainerInterface $c)
    {
        /**
         * Swift mailer transport
         * @see http://swiftmailer.org/docs/sending.html#transport-types
         */
        $transport = \Swift_SmtpTransport::newInstance();

        /**
         * Swift mailer
         * @see http://swiftmailer.org/docs/sending.html#available-methods-for-sending-messages
         */
        return new \Swift_Mailer($transport);
    }
}
