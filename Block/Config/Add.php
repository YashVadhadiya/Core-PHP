<?php 

Ccc::loadClass('Block_Core_Template');
class Block_Config_Add extends Block_Core_Template
{
	public function __construct()
	{
		$this->setTemplate('view/config/add.php');
	}
}

?>