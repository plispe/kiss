<?php

namespace App\Model\Entity;

/**
 * Class City
 * @package App\Model\Entity
 * @author Petr Pliska <petr.pliska@post.cz>
 */

use CCMBenchmark\Ting\Entity\NotifyProperty;
use CCMBenchmark\Ting\Entity\NotifyPropertyInterface;

class City implements NotifyPropertyInterface
{
    use NotifyProperty;

    protected $id = null;
    protected $name = null;
    protected $countryCode = null;
    protected $district = null;
    protected $population = null;
    protected $dt = null;

    public function setId($id)
    {
        $this->propertyChanged('id', $this->id, $id);
        $this->id = (int)$id;
    }

    public function getId()
    {
        return (int)$this->id;
    }

    public function setName($name)
    {
        $this->propertyChanged('name', $this->name, $name);
        $this->name = (string)$name;
    }

    public function getName()
    {
        return (string)$this->name;
    }

    public function setCountryCode($countryCode)
    {
        $this->propertyChanged('countryCode', $this->countryCode, $countryCode);
        $this->countryCode = (string)$countryCode;
    }

    public function getCountryCode()
    {
        return (string)$this->countryCode;
    }

    public function setDistrict($district)
    {
        $this->propertyChanged('district', $this->district, $district);
        $this->district = (string)$district;
    }

    public function getDistrict()
    {
        return (string)$this->district;
    }

    public function setPopulation($population)
    {
        $this->propertyChanged('population', $this->population, $population);
        $this->population = (int)$population;
    }

    public function getPopulation()
    {
        return (int)$this->population;
    }

    public function setDt(\DateTime $dt = null)
    {
        $this->propertyChanged('dt', $this->dt, $dt);
        $this->dt = $dt;
    }

    public function getDt()
    {
        if (is_object($this->dt) === true) {
            return clone $this->dt;
        }

        return $this->dt;
    }

    public function setTutu($value)
    {
        $this->tutu = $value;
    }

    public function setBroum($value)
    {
        $this->broum = $value;
    }

    public function countryIs(Country $country)
    {
        $this->country = $country;
    }
}
