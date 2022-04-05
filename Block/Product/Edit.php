<?php 

Ccc::loadClass('Block_Core_Edit');
Ccc::loadClass('Block_Product_Edit_Tab');
class Block_Product_Edit extends Block_Core_Edit
{
	public function __construct()
	{
		parent::__construct();
	}
	
	public function getProducts()
	{
		return Ccc::getRegistry('product');
	}

	public function getMedia()
	{
		return $this->getData('media');
	}

   public function getCategories()
	{
		$categoryModel = Ccc::getModel('Category');
		$categories = $categoryModel->fetchAll("SELECT *  FROM category  WHERE status = 1");
		return $categories;
	}

	public function getCategoryWithPath()
	{
		Ccc::loadClass('Controller_Category');
		$categoryModel = new Controller_Category();
		$categoryPath = $categoryModel->getCategoryWithPath();
		return $categoryPath;
	}

	public function getCategoryProductPair()
	{	
		return $this->getData('categoryProductPair');
	}

	public function getSaveUrl()
	{
		return $this->getUrl('save',null,['tab' => null]);
	}

}
