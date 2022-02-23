<?php 
Ccc::loadClass('Model_Core_Table');
class Model_Customer_Address_Resource extends Model_Core_Table
{
    public function __construct()
    {
        
        $this->setTableName('address')->setPrimaryKey('addressId');
        $this->setRowClassName('Customer_Address');
    }
}


/*Ccc::loadClass('Model_Core_Table_Row');
class Model_Customer_Address_Row extends Model_Core_Table_Row
{
	public function __construct()
	{
		$this->setTableClassName('Customer_Address');
	}
}*/

?>