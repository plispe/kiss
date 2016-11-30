<?php

namespace App\Vendor\CCMBenchmark\Ting;

use App\Model\Entity\Changelog;
use CCMBenchmark\Ting\ConnectionPool;
use CCMBenchmark\Ting\Entity\NotifyPropertyInterface;
use CCMBenchmark\Ting\Entity\PropertyListenerInterface;
use CCMBenchmark\Ting\MetadataRepository;
use CCMBenchmark\Ting\Query\QueryFactoryInterface;
use CCMBenchmark\Ting\Repository\Metadata;
use CCMBenchmark\Ting\UnitOfWork;

/**
 * Class ChangeloggedIdentityAwareUnityOfWork
 * @package App\Vendor\CCMBenchmark\Ting
 * @author Petr Pliska <petr.pliska@post.cz>
 */
class ChangeloggedIdentityAwareUnityOfWork extends UnitOfWork
{
    protected $identity;

    public function __construct(
        ConnectionPool $connectionPool,
        MetadataRepository $metadataRepository,
        QueryFactoryInterface $queryFactory,
        int $identity = 0
    ) {
        parent::__construct($connectionPool, $metadataRepository, $queryFactory);

        $this->identity = $identity;
    }
    /**
     * Update all applicable entities in database
     *
     * @param $uuid
     * @throws \Exception
     */
    protected function processManaged($uuid)
    {
        if (isset($this->entitiesChanged[$uuid]) === false) {
            return;
        }

        $entity = $this->entities[$uuid];
        $properties = $this->extractChangedProperties($uuid);

        if ($properties === []) {
            return;
        }

        $this->metadataRepository->findMetadataForEntity(
            $entity,
            function (Metadata $metadata) use ($entity, $properties, $uuid) {
                $connection = $metadata->getConnection($this->connectionPool);
                $query = $metadata->generateQueryForUpdate(
                    $connection,
                    $this->queryFactory,
                    $entity,
                    $properties
                );

                $this->addStatementToClose($query->getStatementName(), $connection->master());
                $query->prepareExecute()->execute();

                unset($this->entitiesChanged[$uuid]);
                unset($this->entitiesShouldBePersisted[$uuid]);
                $this->addToChangelog($metadata->getTable(), $entity, $properties);
            },
            function () use ($entity) {
                throw new \Exception('Could not find repository matching entity "' . get_class($entity) . '"');
            }
        );
    }

    /**
     * Insert all applicable entities in database
     *
     * @param $uuid
     * @throws Exception
     */
    protected function processNew($uuid)
    {
        $entity = $this->entities[$uuid];
        $this->metadataRepository->findMetadataForEntity(
            $entity,
            function (Metadata $metadata) use ($entity, $uuid) {
                $connection = $metadata->getConnection($this->connectionPool);
                $query = $metadata->generateQueryForInsert(
                    $connection,
                    $this->queryFactory,
                    $entity
                );

                $this->addStatementToClose($query->getStatementName(), $connection->master());
                $query->prepareExecute()->execute();

                $metadata->setEntityPropertyForAutoIncrement($entity, $connection->master());

                unset($this->entitiesChanged[$uuid]);
                unset($this->entitiesShouldBePersisted[$uuid]);
//                $this->addToChangelog($metadata->getTable(), $entity, $properties);
                $this->manage($entity);
            },
            function () use ($entity) {
                throw new Exception('Could not find repository matching entity "' . get_class($entity) . '"');
            }
        );
    }

    /**
     * Delete all flagged entities from database
     *
     * @param $uuid
     * @throws \Exception
     */
    protected function processDelete($uuid)
    {
        $entity = $this->entities[$uuid];

        $properties = $this->extractChangedProperties($uuid);

        $this->metadataRepository->findMetadataForEntity(
            $entity,
            function (Metadata $metadata) use ($entity, $properties) {
                $connection = $metadata->getConnection($this->connectionPool);
                $query = $metadata->generateQueryForDelete(
                    $connection,
                    $this->queryFactory,
                    $properties,
                    $entity
                );
                $this->addStatementToClose($query->getStatementName(), $connection->master());
                $query->prepareExecute()->execute();
                $this->detach($entity);

                $this->addToChangelog($metadata->getTable(), $entity, $properties);
            },
            function () use ($entity) {
                throw new Exception('Could not find repository matching entity "' . get_class($entity) . '"');
            }
        );
    }

    /**
     * @param string $table
     * @param PropertyListenerInterface $entity
     * @param array $properties
     */
    protected function addToChangelog(string $table, NotifyPropertyInterface $entity, array $properties)
    {
        if ($entity instanceof Changelog) {
            return;
        }

        foreach ($properties as $property => list($oldValue, $newValue)) {
            $changeLog = new Changelog;

            $changeLog->setTable($table);
            $changeLog->setRecordId($entity->getId());
            $changeLog->setProperty($property);
            $changeLog->setOldValue($oldValue);
            $changeLog->setNewValue($newValue);
            $changeLog->setIdentity($this->identity);
            $this->pushSave($changeLog)->process();
        }
    }

    /**
     * @param string $uuid
     * @return array
     */
    protected function extractChangedProperties(string $uuid): array
    {
        $properties = [];
        if (isset($this->entitiesChanged[$uuid])) {
            foreach ($this->entitiesChanged[$uuid] as $property => $values) {
                if ($values[0] !== $values[1]) {
                    $properties[$property] = $values;
                }
            }
        }

        return $properties;
    }
}