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

    protected $code = null;
    protected $name = null;
    protected $continent = null;
    protected $region = null;
    protected $president = null;

    public function setCode($code)
    {
        $this->propertyChanged('code', $this->code, $code);
        $this->code = (string)$code;
    }

    public function getCode()
    {
        return (string)$this->code;
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

    public function setContinent($continent)
    {
        $this->propertyChanged('continent', $this->continent, $continent);
        $this->continent = (string)$continent;
    }

    public function getContinent()
    {
        return (string)$this->continent;
    }

    public function setRegion($region)
    {
        $this->propertyChanged('region', $this->region, $region);
        $this->region = (string)$region;
    }

    public function getRegion()
    {
        return (string)$this->region;
    }

    public function setPresident($president)
    {
        $this->propertyChanged('president', $this->president, $president);
        $this->president = (string)$president;
    }

    public function getPresident()
    {
        return (string)$this->president;
    }

    public function countryLanguageIs(CountryLanguage $countryLanguage)
    {
        $this->countryLanguage = $countryLanguage;
    }

}