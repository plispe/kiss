<?php

/**
 * Swift mailer PHP-DI factory
 *
 * @see http://swiftmailer.org/
 * @author Petr Pliska <petr.pliska@post.cz>
 */

namespace App\Factory\Mailer;

use Interop\Container\ContainerInterface;

class SwiftMailer
{
    /**
     * @param ContainerInterface $c
     * @return Swift_Mailer
     */
    public function create(ContainerInterface $c)
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
