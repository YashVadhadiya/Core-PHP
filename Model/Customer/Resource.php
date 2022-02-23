<?php 
Ccc::loadClass('Model_Core_Table');
class Model_Customer_Resource extends Model_Core_Table
{
    public function __construct()
    {
        $this->setTableName('customer')->setPrimaryKey('id');
        $this->setRowClassName('Customer');
    }
}




/*
Ccc::loadClass('Model_Core_Table_Row');
class Model_Customer_Row extends Model_Core_Table_Row
{
	public function __construct()
	{
		$this->setTableClassName('Customer');
	}
}*/

?>