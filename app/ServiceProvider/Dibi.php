<?php

namespace App\ServiceProvider;

/**
 * Dibi database abstraction library
 * @see https://dibiphp.com/
 */
use Dibi\Connection;

/**
 * Utility for parsion DSN
 * @see https://github.com/AD7six/php-dsn
 */
use AD7six\Dsn\DbDsn;

/**
 * Standard service providers
 * @see https://github.com/container-interop/service-provider
 */
use Interop\Container\ServiceProvider;

/**
 * Class Dibi
 * @package App\ServiceProvider
 * @author Petr Pliska <petr.pliska@post.cz>
 */
class Dibi implements ServiceProvider
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
            Connection::class => function () {
                return new Connection($this->getConnection());
            }
        ];
    }

    /**
     * @return array
     */
    protected function getConnection()
    {
        /**
         * uses AD7six/php-dsn utility for parsing database DSN
         * @see https://github.com/AD7six/php-dsn
         */
        $dsn = new DbDsn(getenv('DATABASE_DSN'));

        return [
            'driver' => $dsn->getEngine(),
            'host' => $dsn->getHost(),
            'user' => $dsn->getUser(),
            'password' => $dsn->getPassword(),
            'database' => $dsn->getDatabase(),
        ];
    }
}
