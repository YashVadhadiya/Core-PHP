<?php Ccc::loadClass('Block_Core_Template'); ?>

<?php 
class Block_Core_Grid_Collection extends Block_Core_Template
{
	protected $collections = [];
	protected $columns = [];
	protected $actions= [];

	public function __construct()
	{
		$this->setTemplate('view/core/grid/collection.php');
		$this->prepareCollections();
		$this->prepareColumns();
		$this->prepareActions();
	}

	public function prepareCollections()
	{
		return $this;
	}
	
	public function prepareColumns()
	{
		return $this;
	}
	
	public function prepareActions()
	{
		return $this;
	}

	public function setColumns(array $columns)
	{
		$this->columns = $columns;
		return $this; 
	}

	public function getColumns()
	{
		return $this->columns;
	}

	public function addColumn($columns,$key)
	{
		$this->columns[$key] = $columns;
		return $this;
	}

	public function getColumn($key)
	{
		if (!array_key_exists($key,$this->columns)) 
		{
			return null;
		}
		return $this->columns[$key];
	}

	public function removeColumns($key)
	{
		
		if (array_key_exists($key,$this->columns)) 
		{
			unset($key,$this->columns);
		}
		return $this;
	}
	
	public function resetColumns()
	{
		$this->columns = [];
		return $this;
	}

	public function setActions(array $columns)
	{
		$this->actions = $actions;
		return $this; 
	}

	public function getActions()
	{
		return $this->actions;
	}

	public function addAction($action,$key)
	{
		$this->actions[$key] = $action;
		return $this;
	}

	public function getAction($key)
	{
		if (!array_key_exists($key,$this->actions)) 
		{
			return null;
		}
		return $this->actions[$key];
	}

	public function removeAction($key)
	{
		
		if (array_key_exists($key,$this->actions)) 
		{
			unset($key,$this->actions);
		}
		return $this;
	}
	
	public function resetActions()
	{
		$this->actions = [];
		return $this;
	}

	
	public function setColections(array $collections)
	{
		$this->collections = $collections;
		return $this;
	}

	public function getCollections()
	{
		return $this->collections;
	}

	public function addCollection($collection,$key)
	{
		$this->collections[$key] = $collection;
		return $this;
	}

	public function getCollection($key)
	{
		if (!array_key_exists($key,$this->collections)) 
		{
			return null;
		}
		return $this->collections[$key];
	}

	public function removeCollection($key)
	{
		
		if (array_key_exists($key,$this->collections)) 
		{
			unset($key,$this->collections);
		}
		return $this;
	}
	
	public function resetCollections()
	{
		$this->collections = [];
		return $this;
	}

}