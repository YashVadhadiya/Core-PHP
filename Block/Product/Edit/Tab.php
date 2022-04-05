<?php 

Ccc::loadClass('Block_Core_Edit_Tab');

class Block_Product_Edit_Tab extends Block_Core_Edit_Tab
{

	public function __construct()
	{
		parent::__construct();
		$this->setCurrentTab('product');
	}

	public function prepareTabs()
	{ 
		$this->addTab(
			[
			'title' => 'Product Information',
			'block' => 'Product_Edit_Tabs_Product',
			'url' => $this->getUrl(null,null,['tab' => 'product'])],'product');

		$this->addTab(
			[
			'title' => 'Category Information',
			'block' => 'Product_Edit_Tabs_Category',
			'url' => $this->getUrl(null,null,['tab' => 'category'])],'category');		
		$this->addTab(
			[
			'title' => 'Media Information',
			'block' => 'Product_Edit_Tabs_Media',
			'url' => $this->getUrl(null,null,['tab' => 'media'])],'media');

		
		return $this;
	}

}