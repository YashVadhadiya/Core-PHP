<?php
class Model_Core_Row_Resource
{
	protected $tableName = null;

    protected $primaryKey = null;

    protected $rowClassName = null;

    public function __construct()
    {
        
    }

    public function getRowClassName()
    {
        return $this->rowClassName;
    }

    public function setRowClassName($rowClassName)
    {
        $this->rowClassName = $rowClassName;
        return $this;
    }

    public function getRow()
    {
        return Ccc::getModel($this->getRowClassName());
    }

    public function setTableName($tableName)
    {
        $this->tableName = $tableName;
        return $this;
    }

    public function getTableName()
    {
        return $this->tableName;
    }

    public function getPrimaryKey()
    {
        return $this->primaryKey;
    }

    public function setPrimaryKey($primaryKey)
    {
        $this->primaryKey = $primaryKey;
        return $this;
    }

    public function insert(array $queryInsert)
    {
        if(!$queryInsert){
            return false;
        }
        $adapter = new Model_Core_Adapter();
        $key = '`'.implode("`,`", array_keys($queryInsert)).'`';
        $value = '\''.implode("','", array_values($queryInsert)).'\'';

        $sqlResult = "INSERT INTO `{$this->getTableName()}` ({$key}) VALUES ({$value});";
        $result = $adapter->insert($sqlResult);
        return $result;
    }

    public function delete(array $queryDelete)
    {
        $adapter = new Model_Core_Adapter();
        $tableName = $this->getTableName();
        $key = key($queryDelete);
        $value = $queryDelete[$key];
        $sqlResult = "DELETE FROM $tableName WHERE $key = $value;";
        $result = $adapter->delete($sqlResult);
        return $result;
    }

    public function update(array $queryUpdate, array $queryId)
    {
        $adapter = new Model_Core_Adapter();
        $date = date("Y-m-d H:i:s");
        $set = [];
        $tableName = $this->getTableName();
        $key = key($queryId);
        $value = $queryId[$this->primaryKey];
        
        foreach ($queryUpdate as $sqlKey => $sqlValue) 
        {
            $set[] = "$sqlKey ='$sqlValue'";
        }
        
        $sql1 = implode(",", $set);
        $update = "UPDATE $tableName SET $sql1 WHERE $key = $value;";
        $result = $adapter->update($update);
        return $result;
    }

    public function fetchRow($queryFetchRow)
    {
        $adapter = new Model_Core_Adapter();
        $tableName = $this->getTableName();
        $result = $adapter->fetchRow($queryFetchRow);
        return $result;
    }

    public function fetchAll($queryFetchAll)
    {
        $adapter = new Model_Core_Adapter();
        $tableName = $this->getTableName();
        $result = $adapter->fetchAll($queryFetchAll);
        return $result;
    }
}