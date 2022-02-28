<?php

Ccc::loadClass('Block_Core_Template');
Ccc::loadClass('Block_Core_Layout_Header');
Ccc::loadClass('Block_Core_Layout_Footer');
Ccc::loadClass('Block_Core_Layout_Content');

class Block_Core_Layout extends Block_Core_Template
{
	public function __construct()
	{
		$this->setTemplate('view/core/layout.php');
	}

	public function getHeader()
	{
			return Ccc::getBlock('Core_Layout_Header');
	}

	public function getFooter()
	{
			return Ccc::getBlock('Core_Layout_Footer');
	}

	public function getContent()
	{
			return Ccc::getBlock('Core_Layout_Content');
	}
}

?>