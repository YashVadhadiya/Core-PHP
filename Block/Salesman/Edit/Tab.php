<?php 
Ccc::loadClass('Block_Core_Edit_Tab');

class Block_Salesman_Edit_Tab extends Block_Core_Edit_Tab
{
	public function __construct()
	{
		parent::__construct();
		$this->setCurrentTab('personal');
	}

	public function prepareTabs()
	{ 
		$this->addTab(
			[
			'title' => 'Personal Information',
			'block' => 'Salesman_Edit_Tabs_Personal',
			'url' => $this->getUrl(null,null,['tab' => 'personal'])],'personal');
		
		$this->addTab(	
			[
			'title' => 'Customer Information',
			'block' => 'Salesman_Edit_Tabs_Customer',
			'url' => $this->getUrl(null,null,['tab' => 'customer'])],'customer');	
		$this->addTab(	
			[
			'title' => 'Price Information',
			'block' => 'Salesman_Edit_Tabs_Price',
			'url' => $this->getUrl(null,null,['tab' => 'price'])],'price');	
		
		return $this;
	}

}