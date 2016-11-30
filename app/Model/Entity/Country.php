<?php

namespace App\Model\Entity;

use CCMBenchmark\Ting\Entity\NotifyProperty;
use CCMBenchmark\Ting\Entity\NotifyPropertyInterface;

/**
 * Class Country
 * @package App\Model\Entity
 * @author Petr Pliska <petr.pliska@post.cz>
 */
class Country implements NotifyPropertyInterface
{
    use NotifyProperty;

    /**
     * @var null
     */
    protected $code = null;

    /**
     * @var null
     */
    protected $name = null;

    /**
     * @var null
     */
    protected $continent = null;

    /**
     * @var null
     */
    protected $region = null;

    /**
     * @var null
     */
    protected $president = null;

    /**
     * @param $code
     */
    public function setCode($code)
    {
        $this->propertyChanged('code', $this->code, $code);
        $this->code = (string)$code;
    }

    /**
     * @return string
     */
    public function getCode()
    {
        return (string)$this->code;
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
     * @param $continent
     */
    public function setContinent($continent)
    {
        $this->propertyChanged('continent', $this->continent, $continent);
        $this->continent = (string)$continent;
    }

    /**
     * @return string
     */
    public function getContinent()
    {
        return (string)$this->continent;
    }

    /**
     * @param $region
     */
    public function setRegion($region)
    {
        $this->propertyChanged('region', $this->region, $region);
        $this->region = (string)$region;
    }

    /**
     * @return string
     */
    public function getRegion()
    {
        return (string)$this->region;
    }

    /**
     * @param $president
     */
    public function setPresident($president)
    {
        $this->propertyChanged('president', $this->president, $president);
        $this->president = (string)$president;
    }

    /**
     * @return string
     */
    public function getPresident()
    {
        return (string)$this->president;
    }

    /**
     * @param CountryLanguage $countryLanguage
     */
    public function countryLanguageIs(CountryLanguage $countryLanguage)
    {
        $this->countryLanguage = $countryLanguage;
    }

}
