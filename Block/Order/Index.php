<?php Ccc::loadClass('Block_Core_Template'); ?>

<?php 
class Block_Order_Index extends Block_Core_Template
{
	public function __construct()
	{
		parent::__construct();
		$this->setTemplate('view/order/index.php');
	}
}