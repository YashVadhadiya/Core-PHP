<?php

Ccc::loadClass('Block_Core_Edit_Tabs_Content');
Ccc::loadClass('Block_Category_Edit_Tab');

class Block_Category_Edit_Tabs_category extends Block_Core_Edit_Tabs_Content
{
	public function __construct()
	{
		$this->setTemplate('view/category/edit/tabs/category.php');
	}

	public function getCategories()
	{
		return Ccc::getRegistry('category');	
	}

	public function getCategoryWithPath()
	{
		Ccc::loadClass('Controller_Category');
		$categoryModel = new Controller_Category();
		$categoryPath = $categoryModel->getCategoryWithPath();
		return $categoryPath;
	}
}