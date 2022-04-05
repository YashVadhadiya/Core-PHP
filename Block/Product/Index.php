<?php Ccc::loadClass('Block_Core_Template'); ?>

<?php 
class Block_Product_Index extends Block_Core_Template
{
	public function __construct()
	{
		parent::__construct();
		$this->setTemplate('view/product/index.php');
	}
}