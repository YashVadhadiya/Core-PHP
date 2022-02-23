<?php
/*Ccc::loadClass('Model_Core_Table');
class Model_Product extends Model_Core_Table
{
    public function __construct()
    {
        $this->setTableName('product')->setPrimaryKey('id');
        $this->setRowClassName('Product_Row');
    }
}*/

Ccc::loadClass('Model_Core_Table_Row');
class Model_Product extends Model_Core_Table_Row
{
	public function __construct()
	{
		$this->setTableClassName('Product_Resource');
	}
	//row model
}

?>