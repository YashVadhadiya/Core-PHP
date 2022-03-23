<?php Ccc::loadClass('Model_Core_Row_Resource'); ?>
<?php
class Model_Cart_Resource extends Model_Core_Row_Resource
{
	public function __construct()
	{
		$this->setTableName('cart')->setPrimaryKey('cartId');
		parent::__construct();
	}
}

