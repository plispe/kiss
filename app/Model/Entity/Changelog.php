<?php

namespace App\Model\Entity;

use CCMBenchmark\Ting\Entity\NotifyProperty;
use CCMBenchmark\Ting\Entity\NotifyPropertyInterface;

/**
 * Class Changelog
 * @package App\Model\Entity
 * @author Petr Pliska <petr.pliska@post.cz>
 */
class Changelog implements NotifyPropertyInterface
{
    use NotifyProperty;

    /**
     * @var
     */
    protected $id;

    /**
     * @var
     */
    protected $table;

    /**
     * @var
     */
    protected $recordId;

    /**
     * @var
     */
    protected $property;

    /**
     * @var
     */
    protected $oldValue;

    /**
     * @var
     */
    protected $newValue;

    /**
     * @var
     */
    protected $identity;

    /**
     * @return mixed
     */
    public function getId()
    {
        return (int) $this->id;
    }

    /**
     * @param $id
     */
    public function setId($id)
    {
        $this->propertyChanged('id', $this->id, $id);
        $this->id = (int) $id;
    }

    /**
     * @return mixed
     */
    public function getTable()
    {
        return $this->table;
    }

    /**
     * @param mixed $table
     */
    public function setTable($table)
    {
        $this->propertyChanged('table', $this->table, $table);
        $this->table = $table;
    }

    /**
     * @return mixed
     */
    public function getRecordId()
    {
        return $this->recordId;
    }

    /**
     * @param mixed $recordId
     */
    public function setRecordId($recordId)
    {
        $this->propertyChanged('recordId', $this->recordId, $recordId);
        $this->recordId = $recordId;
    }

    /**
     * @return mixed
     */
    public function getProperty()
    {
        return $this->property;
    }

    /**
     * @param mixed $property
     */
    public function setProperty($property)
    {
        $this->propertyChanged('property', $this->property, $property);
        $this->property = $property;
    }

    /**
     * @return mixed
     */
    public function getOldValue()
    {
        return $this->oldValue;
    }

    /**
     * @param mixed $oldValue
     */
    public function setOldValue($oldValue)
    {
        $this->propertyChanged('oldValue', $this->oldValue, $oldValue);
        $this->oldValue = $oldValue;
    }

    /**
     * @return mixed
     */
    public function getNewValue()
    {
        return $this->newValue;
    }

    /**
     * @param mixed $newValue
     */
    public function setNewValue($newValue)
    {
        $this->propertyChanged('newValue', $this->newValue, $newValue);
        $this->newValue = $newValue;
    }

    /**
     * @return int
     */
    public function getIdentity()
    {
        return (int) $this->identity;
    }

    /**
     * @param $identity
     */
    public function setIdentity($identity)
    {
        $this->identity = (int) $identity;
    }
}
