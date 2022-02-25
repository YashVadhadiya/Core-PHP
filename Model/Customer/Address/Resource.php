<?php 
Ccc::loadClass('Model_Core_Row_Resource');
class Model_Customer_Address_Resource extends Model_Core_Row_Resource
{
    public function __construct()
    {
        
        $this->setTableName('address')->setPrimaryKey('addressId')->setRowClassName('Customer_Address_Resource');
    }
}
?>