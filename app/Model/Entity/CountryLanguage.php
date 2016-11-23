<?php

namespace App\Model\Entity;

use CCMBenchmark\Ting\Entity\NotifyProperty;
use CCMBenchmark\Ting\Entity\NotifyPropertyInterface;

/**
 * Class CountryLanguage
 * @package App\Model\Entity
 * @author Petr Pliska <petr.pliska@post.cz>
 */
class CountryLanguage implements NotifyPropertyInterface
{
    use NotifyProperty;

    protected $code = null;
    protected $language = null;
    protected $official = null;
    protected $percentage = null;

    public function setCode($code)
    {
        $this->propertyChanged('code', $this->code, $code);
        $this->code = (string)$code;
    }

    public function getCode()
    {
        return (string)$this->code;
    }

    public function setLanguage($language)
    {
        $this->propertyChanged('language', $this->language, $language);
        $this->language = (string)$language;
    }

    public function getLanguage()
    {
        return (string)$this->language;
    }

    public function setIsOfficial($official)
    {
        $this->propertyChanged('official', $this->official, $official);
        $this->official = (string)$official;
    }

    public function getOfficial()
    {
        return (string)$this->official;
    }

    public function setPercentage($percentage)
    {
        $this->propertyChanged('percentage', $this->percentage, $percentage);
        $this->percentage = (string)$percentage;
    }

    public function getPercentage()
    {
        return (string)$this->percentage;
    }
}
