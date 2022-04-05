<?php Ccc::loadClass('Block_Core_Template'); ?>

<?php 
class Block_Category_Index extends Block_Core_Template
{
	public function __construct()
	{
		parent::__construct();
		$this->setTemplate('view/Category/index.php');
	}
}