<?php Ccc::loadClass('Block_Core_Template'); ?>
<?php 
class Block_Core_Grid extends Block_Core_Template
{
	protected $collections = [];
	protected $columns = [];
	protected $actions = [];

	public function __construct()
	{
		$this->setTemplate('view/core/grid.php');
		$this->prepareCollections();
		$this->prepareColumns();
		$this->prepareActions();
	}

	public function getColumnValue($row, $key, $column)
	{
		if($row->id){
			$mediaModel = Ccc::getModel('Product_Media');
		}

		if($row->categoryId){
			$mediaModel = Ccc::getModel('Category_Media');
			$getCategoryWithPath = Ccc::getBlock('Category_Grid')->getCategoryWithPath();
		}
	    		
	    if($row->categoryId && $key == 'categoryName')
	    {
	    	$result = $getCategoryWithPath;
	    	return $result[$row->categoryId];
	    }
		if($key == 'baseImage')
		{
			return $mediaModel->getImageUrl() . $row->baseImage;
		}

		if($key == 'smallImage')
		{
			return $mediaModel->getImageUrl() . $row->smallImage;
		}
		
		if($key == 'thumbImage')
		{
			return $mediaModel->getImageUrl() . $row->thumbImage;
		}

		if ($key == 'status') 
		{
			return $row->getStatus($row->$key);
		}

		/*if ($key == 'state') 
		{
			return $row->getState($row->$key);
		}*/
		return $row->$key;
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

	public function addColumn($key, $columns)
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

	public function setActions(array $actions)
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

	
	public function setCollections(array $collections)
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