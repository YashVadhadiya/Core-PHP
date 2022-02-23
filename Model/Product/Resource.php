<?php 
/*Ccc::loadClass('Model_Core_Table_Row');
class Model_Product_Row extends Model_Core_Table_Row
{
	public function __construct()
	{
		$this->setTableClassName('Product');
	}
	//row model
}*/

Ccc::loadClass('Model_Core_Table');
class Model_Product_Resource extends Model_Core_Table
{
    public function __construct()
    {
        $this->setTableName('product')->setPrimaryKey('id');
        $this->setRowClassName('Product');
    }
}
?>