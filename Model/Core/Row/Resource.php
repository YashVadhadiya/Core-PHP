<?php
class Model_Core_Row_Resource
{
	protected $tableName = null;

    protected $primaryKey = null;

    public function __construct()
    {
        
    }

    public function getAdapter()
    {
        $adapter = new Model_Core_Adapter();
        return $adapter;
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
        
        
        $key = '`'.implode("`,`", array_keys($queryInsert)).'`';
        $value = '\''.implode("','", array_values($queryInsert)).'\'';

        $sqlResult = "INSERT INTO `{$this->getTableName()}` ({$key}) VALUES ({$value});";
        $result = $this->getAdapter()->insert($sqlResult);
        return $result;
    }

    public function delete(array $queryDelete)
    {
        
        $tableName = $this->getTableName();
        $key = key($queryDelete);
        $value = $queryDelete[$key];
        $sqlResult = "DELETE FROM $tableName WHERE $key = $value;";
        $result = $this->getAdapter()->delete($sqlResult);
        return $result;
    }

    /*public function update(array $queryUpdate, array $queryId)
    {
        
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
        $result = $this->getAdapter()->update($update);
        return $result;
    }*/

    public function update($data,$id)
    {
        $whereClause = null;
        $fields = null;     
        if(!is_array($id))
        {
            $whereClause = '`'.$this->getPrimaryKey().'`'." = '".$this->getAdapter()->escapString($id)."'";
        }
        else
        {
            foreach ($id as $key => $value) 
            {
                $whereClause = $whereClause .'`'.$key.'`'. " = '".$value."' and ";
            }
            $whereClause = rtrim($whereClause,' and ');
        }
        foreach ($data as $col => $value) 
        {
            if($value != null)
            {
                $fields = $fields .'`'.$col.'`'. " = '".$this->getAdapter()->escapString($value)."',";

            }
            else
            {
                $fields = $fields . $col . ' = null ,';
            }
        }

        $fields = rtrim($fields,',');
        $query = "UPDATE ".'`'.$this->getTableName().'`'." SET ".$fields." WHERE ".$whereClause;
        return $this->getAdapter()->update($query);
    }

    public function fetchRow($queryFetchRow)
    {
        
        $tableName = $this->getTableName();
        $result = $this->getAdapter()->fetchRow($queryFetchRow);
        return $result;
    }

    public function fetchAll($queryFetchAll)
    {
        
        $tableName = $this->getTableName();
        $result = $this->getAdapter()->fetchAll($queryFetchAll);
        return $result;
    }
}