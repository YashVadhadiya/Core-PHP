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
        global $adapter;
        foreach ($queryInsert as $columnName => $value) {
            array_push($sqlColumn, $columnName);
            array_push($sqlValue, $value);
        }
        $sql1 = implode(",", $sqlColumn);
        $sql2 = implode("','", $sqlValue);
        $sql3 = "'" . $sql2 . "'";

        $sqlResult = "INSERT INTO admin($sql1) values($sql3);";
        $result = $adapter->insert($sqlResult);
    }

    public function delete(array $queryDelete)
    {
        global $adapter;
        $tableName = $this->getTableName();
        $key = key($queryDelete);
        $value = $queryDelete["id"];
        $sqlResult = "DELETE FROM $tableName WHERE $key = $value;";
        $result = $adapter->delete($sqlResult);
    }

    public function update(array $queryUpdate, array $queryId)
    {
        global $adapter;
        $date = date("Y-m-d H:i:s");
        $set = [];
        $tableName = $this->getTableName();
        $key = key($queryId);
        $value = $queryId["id"];
        foreach ($queryUpdate as $sqlKey => $sqlValue) {
            $set[] = "$sqlKey ='$sqlValue'";
        }
        $sql1 = implode(",", $set);
        $update =
            "UPDATE $tableName SET $sql1, updatedAt = '" .
            $date .
            "' WHERE $key = $value;";
        $result = $adapter->update($update);
    }

    public function fetchRow($queryFetchRow)
    {
        global $adapter;
        $tableName = $this->getTableName();
        $result = $adapter->fetchRow($queryFetchRow);
    }

    public function fetchAll($queryFetchAll)
    {
        global $adapter;
        $tableName = $this->getTableName();
        $result = $adapter->fetchAll($queryFetchAll);
        print_r($result);
        exit();
    }
}

?>
