<?php

namespace App\ServiceProvider;

use AD7six\Dsn\Db\MysqlDsn;
use CCMBenchmark\Ting\Cache\Cache;
use CCMBenchmark\Ting\ConnectionPool;
use CCMBenchmark\Ting\MetadataRepository;
use CCMBenchmark\Ting\Query\QueryFactory;
use CCMBenchmark\Ting\Repository\CollectionFactory;
use CCMBenchmark\Ting\Repository\Hydrator;
use CCMBenchmark\Ting\Repository\HydratorSingleObject;
use CCMBenchmark\Ting\Repository\RepositoryFactory;
use CCMBenchmark\Ting\Serializer\SerializerFactory;
use CCMBenchmark\Ting\UnitOfWork;
use Doctrine\Common\Cache\VoidCache;
use Interop\Container\ContainerInterface;
use Interop\Container\ServiceProvider;

/**
 * Class Ting
 * @package App\ServiceProvider
 */
class Ting implements ServiceProvider
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
        /**
         * uses AD7six/php-dsn utility for parsing database DSN
         * @see https://github.com/AD7six/php-dsn
         */
        $dsn = new MysqlDsn(getenv('DATABASE_DSN'));
        $config = [
            'main' => [
                'namespace' => '\CCMBenchmark\Ting\Driver\Mysqli',
                'master' => [
                    'host' => $dsn->getHost(),
                    'user' => $dsn->getUser(),
                    'password' => $dsn->getPass(),
                    'port' => $dsn->getPort(),
                ],
            ]
        ];
        return [
            ConnectionPool::class => function (ContainerInterface $c) use ($config) {
                $pool = new ConnectionPool;
                $pool->setConfig($config);

                return $pool;
            },

            MetadataRepository::class => function (ContainerInterface $c) {
                $repository = new MetadataRepository($c->get(SerializerFactory::class));
                $repository->batchLoadMetadata('App\Model\Repository', $c->get('app.dir') . '/Model/Repository/*.php');

                return $repository;
            },

            UnitOfWork::class => function (ContainerInterface $c) {
                return new UnitOfWork(
                    $c->get(ConnectionPool::class),
                    $c->get(MetadataRepository::class),
                    $c->get(QueryFactory::class)
                );
            },

            CollectionFactory::class => function (ContainerInterface $c) {
                return new CollectionFactory(
                    $c->get(MetadataRepository::class),
                    $c->get(UnitOfWork::class),
                    $c->get(Hydrator::class)
                );
            },

            QueryFactory::class => function (ContainerInterface $c) {
                return new QueryFactory;
            },

            SerializerFactory::class => function (ContainerInterface $c) {
                return new SerializerFactory;
            },

            Hydrator::class => function (ContainerInterface $c) {
                $hydrator = new Hydrator;

                $hydrator->setMetadataRepository($c->get(MetadataRepository::class));
                $hydrator->setUnitOfWork($c->get(UnitOfWork::class));

                return $hydrator;
            },

            HydratorSingleObject::class => function (ContainerInterface $c) {
                $hydrator = new HydratorSingleObject;

                $hydrator->setMetadataRepository($c->get(MetadataRepository::class));
                $hydrator->setUnitOfWork($c->get(UnitOfWork::class));

                return $hydrator;
            },

            RepositoryFactory::class => function (ContainerInterface $c) {
                return new RepositoryFactory(
                    $c->get(ConnectionPool::class),
                    $c->get(MetadataRepository::class),
                    $c->get(QueryFactory::class),
                    $c->get(CollectionFactory::class),
                    $c->get(UnitOfWork::class),
                    $c->get(Cache::class),
                    $c->get(SerializerFactory::class)
                );
            },
            Cache::class => function (ContainerInterface $c) {
                return new VoidCache;
            }
        ];
    }
}
