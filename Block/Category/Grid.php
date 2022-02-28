<?php 

Ccc::loadClass('Block_Core_Template');
class Block_Category_Grid extends Block_Core_Template
{
	public function __construct()
	{
		$this->setTemplate('view/category/grid.php');
	}

	public function getCategories()
	{
		$category = Ccc::getModel('Category');
		$categories = $category->fetchAll("SELECT c.*,b.image AS baseImage, t.image AS thumbImage, s.image AS smallImage FROM category c LEFT JOIN category_media b ON c.categoryId = b.categoryId AND (b.base = 1) LEFT JOIN category_media t ON c.categoryId = t.categoryId AND (t.thumb = 1) LEFT JOIN category_media s ON c.categoryId = s.categoryId AND (s.small = 1);");
		return $categories;
	}

	public function getCategoryWithPath()
	{
		Ccc::loadClass('Controller_Category');
		$category = new Controller_Category();
		$categoryPath = $category->getCategoryWithPath();
		return $categoryPath;
	}

}

?>