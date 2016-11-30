<?php

namespace App\Model\Repository;

use CCMBenchmark\Ting\Repository\Metadata;
use CCMBenchmark\Ting\Repository\MetadataInitializer;
use CCMBenchmark\Ting\Repository\Repository;
use CCMBenchmark\Ting\Serializer\SerializerFactoryInterface;

/**
 * Class Changelog
 * @package App\Model\Repository
 * @author Petr Pliska <petr.pliska@post.cz>
 */
class Changelog extends Repository implements MetadataInitializer
{
    /**
     * @param  SerializerFactoryInterface $serializerFactory
     * @param  array $options
     * @return \CCMBenchmark\Ting\Repository\Metadata
     */
    public static function initMetadata(SerializerFactoryInterface $serializerFactory, array $options = [])
    {
        $metadata = new Metadata($serializerFactory);
        $metadata->setConnectionName('main');
        $metadata->setDatabase('heroku_44a071ce1e8ee67');
        $metadata->setTable("changelog");
        $metadata->setEntity(\App\Model\Entity\Changelog::class);


        $metadata->addField([
            'primary' => true,
            'autoincrement' => true,
            'fieldName' => 'id',
            'columnName' => 'id',
            'type' => 'int'
        ]);

        $metadata->addField([
            'fieldName' => 'table',
            'columnName' => 'table',
            'type' => "string"
        ]);

        $metadata->addField([
            'fieldName' => 'recordId',
            'columnName' => 'record_id',
            'type' => "int"
        ]);

        $metadata->addField([
            'fieldName' => 'property',
            'columnName' => 'property',
            'type' => "string"
        ]);

        $metadata->addField([
            'fieldName' => 'oldValue',
            'columnName' => 'old_value',
            'type' => "string"
        ]);

        $metadata->addField([
            'fieldName' => 'newValue',
            'columnName' => 'new_value',
            'type' => "string"
        ]);

        $metadata->addField([
            'fieldName' => 'identity',
            'columnName' => 'identity',
            'type' => 'int'
        ]);

        return $metadata;
    }
}