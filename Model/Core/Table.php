<?php

class Model_Core_Table
{
    protected $tableName = null;

    protected $primaryKey = null;

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
        $sqlColumn = [];
        $sqlValue = [];
        $adapter = new Model_Core_Adapter();
        foreach ($queryInsert as $columnName => $value) {
            array_push($sqlColumn, $columnName);
            array_push($sqlValue, $value);
        }
        $sql1 = implode(",", $sqlColumn);
        $sql2 = implode("','", $sqlValue);
        $sql3 = "'" . $sql2 . "'";

        $sqlResult = "INSERT INTO admin($sql1) values($sql3);";
        $result = $adapter->insert($sqlResult);
        return $result;
    }

    public function delete(array $queryDelete)
    {
        $adapter = new Model_Core_Adapter();
        $tableName = $this->getTableName();
        $key = key($queryDelete);
        $value = $queryDelete["id"];
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
        $value = $queryId["id"];
        foreach ($queryUpdate as $sqlKey => $sqlValue) {
            $set[] = "$sqlKey ='$sqlValue'";
        }
        $sql1 = implode(",", $set);
        $update = "UPDATE $tableName SET $sql1, updatedAt = '" .$date ."' WHERE $key = $value;";
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

?>
