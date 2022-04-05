<?php Ccc::loadClass('Block_Core_Template'); ?>

<?php 
class Block_Vendor_Index extends Block_Core_Template
{
	public function __construct()
	{
		parent::__construct();
		$this->setTemplate('view/vendor/index.php');
	}
}