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

    /**
     * @var null
     */
    protected $code = null;

    /**
     * @var null
     */
    protected $language = null;

    /**
     * @var null
     */
    protected $official = null;

    /**
     * @var null
     */
    protected $percentage = null;

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
     * @param $language
     */
    public function setLanguage($language)
    {
        $this->propertyChanged('language', $this->language, $language);
        $this->language = (string)$language;
    }

    /**
     * @return string
     */
    public function getLanguage()
    {
        return (string)$this->language;
    }

    /**
     * @param $official
     */
    public function setOfficial($official)
    {
        $this->propertyChanged('official', $this->official, $official);
        $this->official = (string)$official;
    }

    /**
     * @return string
     */
    public function getOfficial()
    {
        return (string)$this->official;
    }

    /**
     * @param $percentage
     */
    public function setPercentage($percentage)
    {
        $this->propertyChanged('percentage', $this->percentage, $percentage);
        $this->percentage = (string)$percentage;
    }

    /**
     * @return string
     */
    public function getPercentage()
    {
        return (string)$this->percentage;
    }
}
