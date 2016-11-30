<?php

namespace App\Model\Entity;

/**
 * Class City
 * @package App\Model\Entity
 * @author Petr Pliska <petr.pliska@post.cz>
 */

use CCMBenchmark\Ting\Entity\NotifyProperty;
use CCMBenchmark\Ting\Entity\NotifyPropertyInterface;

/**
 * Class City
 * @package App\Model\Entity
 * @author Petr Pliska <petr.pliska@post.cz>
 */
class City implements NotifyPropertyInterface
{
    use NotifyProperty;

    /**
     * @var null
     */
    protected $id = null;

    /**
     * @var null
     */
    protected $name = null;

    /**
     * @var null
     */
    protected $countryCode = null;

    /**
     * @var null
     */
    protected $district = null;

    /**
     * @var null
     */
    protected $population = null;

    /**
     * @var null
     */
    protected $dt = null;

    /**
     * @param $id
     */
    public function setId($id)
    {
        $this->propertyChanged('id', $this->id, $id);
        $this->id = (int)$id;
    }

    /**
     * @return int
     */
    public function getId()
    {
        return (int)$this->id;
    }

    /**
     * @param $name
     */
    public function setName($name)
    {
        $this->propertyChanged('name', $this->name, $name);
        $this->name = (string)$name;
    }

    /**
     * @return string
     */
    public function getName()
    {
        return (string)$this->name;
    }

    /**
     * @param $countryCode
     */
    public function setCountryCode($countryCode)
    {
        $this->propertyChanged('countryCode', $this->countryCode, $countryCode);
        $this->countryCode = (string)$countryCode;
    }

    /**
     * @return string
     */
    public function getCountryCode()
    {
        return (string)$this->countryCode;
    }

    /**
     * @param $district
     */
    public function setDistrict($district)
    {
        $this->propertyChanged('district', $this->district, $district);
        $this->district = (string)$district;
    }

    /**
     * @return string
     */
    public function getDistrict()
    {
        return (string)$this->district;
    }

    /**
     * @param $population
     */
    public function setPopulation($population)
    {
        $this->propertyChanged('population', $this->population, $population);
        $this->population = (int)$population;
    }

    /**
     * @return int
     */
    public function getPopulation()
    {
        return (int)$this->population;
    }

    /**
     * @param \DateTime|null $dt
     */
    public function setDt(\DateTime $dt = null)
    {
        $this->propertyChanged('dt', $this->dt, $dt);
        $this->dt = $dt;
    }

    /**
     * @return null
     */
    public function getDt()
    {
        if (is_object($this->dt) === true) {
            return clone $this->dt;
        }

        return $this->dt;
    }

    /**
     * @param $value
     */
    public function setTutu($value)
    {
        $this->tutu = $value;
    }

    /**
     * @param $value
     */
    public function setBroum($value)
    {
        $this->broum = $value;
    }

    /**
     * @param Country $country
     */
    public function countryIs(Country $country)
    {
        $this->country = $country;
    }
}
