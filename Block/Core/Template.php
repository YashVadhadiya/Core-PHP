<?php 

Ccc::loadClass('Model_Core_View');
class Block_Core_Template extends Model_Core_View
{
	protected $children = [];
	protected $pager;
	protected $layout = null;

	public function __construct()
	{
		// code...
	}

	public function getBlock($key)
	{
		$block = $this->getChild($key);
		if($block)
		{
			return $block;
		}
		$block = Ccc::getBlock($key);
		
		if($block)
		{
			$block->setLayout($this->getLayout());
			return $block;
		}
		return null;
	}

	public function getLayout()
	{
		return $this->layout;
	}

	public function setLayout($layout)
	{
		$this->layout = $layout;
		return $this;
	}

	public function getPager()
	{
		return $this->pager;
	}

	public function setPager($pager)
	{
		$this->pager = $pager;
		return $this->pager;
	}

	public function setChildren($children)
	{
		$this->children = $children;
		return $this;
	}

	public function getChildren()
	{
		return $this->children;
	}

	public function addChild($object , $key = null)
	{
		if(!$key)
		{
			$key = get_class($object);
		}
		$this->children[$key] = $object;
		$object->setLayout($this->getLayout());
		return $this;
	}

	public function removeChild($key)
	{
		if(array_key_exists($key , $this->children))
		{
			unset($this->children[$key]);
			return $this;
		}
	}

	public function getChild($key)
	{
		if(array_key_exists($key , $this->children))
		{
			return $this->children[$key];
		}
		return null;
	}
}

