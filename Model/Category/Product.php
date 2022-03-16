<?php
Ccc::loadClass('Model_Core_Row');

class Model_Category_Product extends Model_Core_Row
{
	public function __construct()
	{
		$this->setResourceClassName('Category_Product_Resource');
		parent::__construct();
	}

	protected $categories; 

	public function getCategories($reload = false)
    {
        $categoriesModel = Ccc::getModel('Category_Product');
        
        if(!$this->categoryId)
        {
            return $categoriesModel;
        }

        if($this->categories && !$reload)
        { 
            return $this->categories;
        }
        $categories = $categoriesModel->fetchAll("SELECT * from category_product WHERE categoryId = {$this->categoryId}");

        if(!$categories)
        {
            return $categoriesModel;
        }
        $this->setCategories($categories);
        return $categories;
    }

    public function setCategories(Model_Category $categories)
    {
        $this->categories = $categories;
        return $this;
    }
}