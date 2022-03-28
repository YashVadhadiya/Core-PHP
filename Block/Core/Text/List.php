<?php
Ccc::loadClass('Block_Core_Template');

class Block_Core_Text_List extends Block_Core_Template
{
	public function __construct()
	{
		parent::__construct();
		$this->setTemplate('view/core/text/list.php');
	}
}