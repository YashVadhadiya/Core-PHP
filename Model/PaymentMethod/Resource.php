<?php

Ccc::loadClass('Model_Core_Row_Resource');
class Model_PaymentMethod_Resource extends Model_Core_Row_Resource
{
	public function __construct()
	{
		$this->setTableName('payment_method')->setPrimaryKey('methodId');
		parent::__construct();
	}
}



