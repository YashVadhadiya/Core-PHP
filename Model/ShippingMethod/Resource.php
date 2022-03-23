<?php

Ccc::loadClass('Model_Core_Row_Resource');
class Model_ShippingMethod_Resource extends Model_Core_Row_Resource
{
	public function __construct()
	{
		$this->setTableName('shipping_method')->setPrimaryKey('methodId');
		parent::__construct();
	}
}



