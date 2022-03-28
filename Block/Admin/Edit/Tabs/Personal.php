<?php

Ccc::loadClass('Block_Core_Template');
Ccc::loadClass('Block_Admin_Edit_Tab');

class Block_Admin_Edit_Tabs_Personal extends Block_Core_Template
{
	public function __construct()
	{
		$this->setTemplate('view/admin/edit/tabs/personal.php');
	}

	public function getAdmin()
	{
		return Ccc::getRegistry('admin');
	}
}