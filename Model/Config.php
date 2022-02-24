<?php

/*Ccc::loadClass('Model_Core_Row');
class Model_Config extends Model_Core_Row
{
    public function __construct()
    {
        $this->setTableClassName('Config_Resource');
    }
}*/

Ccc::loadClass('Model_Core_Row');
class Model_Config extends Model_Core_Row
{
    public function __construct()
    {
        $this->setTableClassName('Config_Resource');
        parent::__construct();
        /*$this->setTableName('config')->setPrimaryKey('configId');
        $this->setRowClassName('Config');*/
    }
}

?>