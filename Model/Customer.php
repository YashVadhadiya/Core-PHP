<?php
Ccc::loadClass('Model_Core_Table_Row');
class Model_Customer extends Model_Core_Table_Row
{
	public function __construct()
	{
		$this->setTableClassName('Customer_Resource');
	}
}


/*Ccc::loadClass('Model_Core_Table');
class Model_Customer extends Model_Core_Table
{
    public function __construct()
    {
        $this->setTableName('customer')->setPrimaryKey('id');
        $this->setRowClassName('Customer_Row');
    }
}*/
?>