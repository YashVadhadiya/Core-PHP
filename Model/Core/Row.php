<?php

class Model_Core_Row
{
    protected $tableClassName;
    protected $data = [];

    public function __construct()
    {
        
    }

    public function getData()
    {
        return $this->data;
    }

    public function setData(array $data)
    {
        $this->data = $data;
        return $this;       
    }

    public function getTableClassName()
    {
        return $this->tableClassName;
    }

    public function setTableClassName($tableClassName)
    {
        $this->tableClassName = $tableClassName;
        return $this;   
    }

    public function resetData()
    {
        $this->data = [];
        return $this;   
    }

    public function __set($key, $value)
    {
        $this->data[$key] = $value;
    }

    public function __get($key)
    {
        if(!array_key_exists($key, $this->data))
        {
            return null;
        }
        return $this->data[$key];
    }

    public function __unset($key)
    {
        unset($this->data[$key]);   
    }

    public function getTable()
    {
        return Ccc::getModel($this->getTableClassName());
        
    }

    public function save()
    {
        if(array_key_exists($this->getTable()->getPrimaryKey(), $this->data))
        {
            $tableName = $this->getTable()->getPrimaryKey();
            $id = $this->data[$this->getTable()->getPrimaryKey()];
            $this->getTable()->update($this->data,[$tableName => $id]);
        }
        else
        {
            $id = $this->getTable()->insert($this->data);
        }
        return $id;
    }

    public function load($id, $column = null)
    {
        if($column == null){
            $column = $this->getTable()->getPrimaryKey();
        }
        $tableName = $this->getTable()->getTableName();
        $query = "SELECT * FROM $tableName WHERE $column = $id";
        
        return $this->fetchRow($query);
        
    }

    public function delete()
    {
        if(!array_key_exists($this->getTable()->getPrimaryKey(), $this->data))
        {
            return false;
        }
        $key = $this->getTable()->getPrimaryKey();
        $value = $this->data[$this->getTable()->getPrimaryKey()];
        $result = $this->getTable()->delete([$key=>$value]);
        return $result;
    }

    public function fetchAll($query)
    {
        $results = $this->getTable()->fetchAll($query);
        if(!$results)
        {
            return $results;
        }
        foreach ($results as &$result) 
        {
            $result = (new $this())->setData($result);
        }
        return $results;
    }

    public function fetchRow($query)
    {
        $result = $this->getTable()->fetchRow($query);
        if(!$result){
            return $result;
        }
        return (new $this())->setData($result);
    }
}


?>
