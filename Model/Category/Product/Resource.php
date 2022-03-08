<?php
Ccc::loadClass('Model_Core_Row_Resource');

class Model_Category_Product_Resource extends Model_Core_Row_Resource
{
	public function __construct()
	{
		$this->setTableName('category_product')->setPrimaryKey('entityId');
		parent::__construct();
	}
}