<?php Ccc::loadClass('Block_Core_Template'); ?>

<?php 
class Block_Page_Index extends Block_Core_Template
{
	public function __construct()
	{
		parent::__construct();
		$this->setTemplate('view/page/index.php');
	}
}
