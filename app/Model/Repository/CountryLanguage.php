<?php

namespace App\Model\Repository;

use CCMBenchmark\Ting\Repository\Metadata;
use CCMBenchmark\Ting\Repository\MetadataInitializer;
use CCMBenchmark\Ting\Serializer\SerializerFactoryInterface;

/**
 * Class CountryLanguage
 * @package App\Model\Repository
 * @author Petr Pliska <petr.pliska@post.cz>
 */
class CountryLanguage extends \CCMBenchmark\Ting\Repository\Repository implements MetadataInitializer
{
    /**
     * @param SerializerFactoryInterface $serializerFactory
     * @param array $options
     * @return Metadata
     */
    public static function initMetadata(SerializerFactoryInterface $serializerFactory, array $options = [])
    {
        $metadata = new Metadata($serializerFactory);

        $metadata->setEntity(\App\Model\Entity\CountryLanguage::class);
        $metadata->setConnectionName('main');
        $metadata->setDatabase('heroku_44a071ce1e8ee67');
        $metadata->setTable('t_countrylanguage_col');

        $metadata->addField([
            'primary' => true,
            'fieldName' => 'code',
            'columnName' => 'cou_code',
            'type' => 'string'
        ]);

        $metadata->addField([
            'primary' => true,
            'fieldName' => 'language',
            'columnName' => 'col_language',
            'type' => 'string'
        ]);

        $metadata->addField([
            'fieldName' => 'official',
            'columnName' => 'col_is_official',
            'type' => 'boolean'
        ]);

        $metadata->addField([
            'fieldName' => 'percentage',
            'columnName' => 'col_percentage',
            'type' => 'double'
        ]);

        return $metadata;
    }
}
