<?php
class Model_Core_Table_Row
{
	protected $tableClassName;
	protected $data = [];

	public function getData()
	{
		return $this->data;
	}

	public function setData(array $data)
	{
		$this->data = $data;
		return $data;		
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
		if(array_key_exists($this->getTable()->getPrimaryKey(),$this->data))
		{
			$tableName = $this->getTable()->getPrimaryKey();
			$id = $this->data[$this->getTable()->getPrimaryKey()];
			$this->getTable()->update($this->data,[$tableName => $id]);
		}
		else
		{
			$id = $this->getTable()->insert($this->data);
		}
		return $this;
	}
}