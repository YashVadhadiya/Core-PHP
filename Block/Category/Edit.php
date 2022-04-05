<?php 
Ccc::loadClass('Block_Core_Edit');
Ccc::loadClass('Block_Category_Edit_Tab');
class Block_Category_Edit extends Block_Core_Edit
{
	public function __construct()
	{
		parent::__construct();
	}

	public function getSaveUrl()
	{
		return $this->getUrl('save',null,['tab' => null]);
	}

	public function getCategoryWithPath()
	{
		Ccc::loadClass('Controller_Category');
		$categoryModel = new Controller_Category();
		$categoryPath = $categoryModel->getCategoryWithPath();
		return $categoryPath;
	}

	public function getCategory()
	{		
		return $this->getData('category');
	}
}