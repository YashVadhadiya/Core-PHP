<?php

Ccc::loadClass('Model_Core_Table');
class Model_Category_Resource extends Model_Core_Table
{
    public function __construct()
    {
        $this->setTableName('category')->setPrimaryKey('categoryId');
        $this->setRowClassName('Category');
    }
}


/*Ccc::loadClass('Model_Core_Table_Row');
class Model_Category_Row extends Model_Core_Table_Row
{
	public function __construct()
	{
		$this->setTableClassName('category');
	}
}
*/
?>