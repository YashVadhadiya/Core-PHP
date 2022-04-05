<?php Ccc::loadClass('Block_Core_Template'); ?>

<?php 
class Block_Customer_Index extends Block_Core_Template
{
	public function __construct()
	{
		parent::__construct();
		$this->setTemplate('view/customer/index.php');
	}
}