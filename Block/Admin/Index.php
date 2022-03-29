<?php Ccc::loadClass('Block_Core_Template'); ?>

<?php 
class Block_Admin_Index extends Block_Core_Template
{
	public function __construct()
	{
		parent::__construct();
		$this->setTemplate('view/admin/index.php');
	}
}
