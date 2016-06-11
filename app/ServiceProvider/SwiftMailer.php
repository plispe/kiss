<?php

namespace App\ServiceProvider;

/**
 * Interop DI intervace
 * @see https://github.com/container-interop/container-interop
 */
use Interop\Container\ServiceProvider;
use Interop\Container\ContainerInterface;


/**
 * Class SwiftMailer
 * @package App\ServiceProvider
 * @author Petr Pliska <petr.pliska@post.cz>
 */
class SwiftMailer implements ServiceProvider
{
    /**
     * Returns a list of all container entries registered by this service provider.
     *
     * - the key is the entry name
     * - the value is a callable that will return the entry, aka the **factory**
     *
     * Factories have the following signature:
     *        function(ContainerInterface $container, callable $getPrevious = null)
     *
     * About factories parameters:
     *
     * - the container (instance of `Interop\Container\ContainerInterface`)
     * - a callable that returns the previous entry if overriding a previous entry, or `null` if not
     *
     * @return callable[]
     */
    public function getServices()
    {
        return [
            Swift_Mailer::class => function (ContainerInterface $container) {
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
        ];
    }
}
