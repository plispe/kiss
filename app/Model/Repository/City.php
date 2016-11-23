<?php

namespace App\Model\Repository;

use CCMBenchmark\Ting\Repository\Metadata;
use CCMBenchmark\Ting\Repository\MetadataInitializer;
use CCMBenchmark\Ting\Serializer\SerializerFactoryInterface;

/**
 * Class City
 * @package App\Model\Repository
 * @author Petr Pliska <petr.pliska@post.cz>
 */
class City extends \CCMBenchmark\Ting\Repository\Repository implements MetadataInitializer
{
    public function getZCountryWithLotsPopulation()
    {

        $query = $this->getQuery(
            'select cit_id, cit_name, cou_code, cit_district, cit_population
                    from t_city_cit as a where cit_name like :name and cit_population > :population limit 3'
        );

        return $query->setParams(['name' => 'Z%', 'population' => 200000])->query();
    }

    public function getNumberOfCities()
    {

        $query = $this->getQuery('select COUNT(*) AS nb from t_city_cit as a WHERE cit_population > :population');

        return $query->setParams(['population' => 20000])->query()->first();
    }

    public static function initMetadata(SerializerFactoryInterface $serializerFactory, array $options = [])
    {
        $metadata = new Metadata($serializerFactory);

        $metadata->setEntity(\App\Model\Entity\City::class);
        $metadata->setConnectionName('main');
        $metadata->setDatabase('heroku_44a071ce1e8ee67');
        $metadata->setTable('t_city_cit');

        $metadata->addField(array(
            'primary' => true,
            'autoincrement' => true,
            'fieldName' => 'id',
            'columnName' => 'cit_id',
            'type' => 'int'
        ));

        $metadata->addField(array(
            'fieldName' => 'name',
            'columnName' => 'cit_name',
            'type' => 'string'
        ));

        $metadata->addField(array(
            'fieldName' => 'countryCode',
            'columnName' => 'cou_code',
            'type' => 'string'
        ));

        $metadata->addField(array(
            'fieldName' => 'district',
            'columnName' => 'cit_district',
            'type' => 'string'
        ));

        $metadata->addField(array(
            'fieldName' => 'population',
            'columnName' => 'cit_population',
            'type' => 'int'
        ));

        return $metadata;
    }
}
