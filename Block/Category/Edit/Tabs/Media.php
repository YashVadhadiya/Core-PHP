<?php

Ccc::loadClass('Block_Core_Edit_Tabs_Content');
Ccc::loadClass('Block_Category_Edit_Tab');

class Block_Category_Edit_Tabs_Media extends Block_Core_Edit_Tabs_Content
{
	public function __construct()
	{
		$this->setTemplate('view/category/edit/tabs/media.php');
	}

	public function getMedias()
    {	//echo "string";
   		$front = Ccc::getFront();
   		$id = $front->getRequest()->getRequest('id');
   		//print_r($id);
   		$categoryMedia = Ccc::getModel('Category_Media');
		$categoryMedias = $categoryMedia->fetchAll("SELECT * FROM `category_media` WHERE `categoryId` = {$id}");
		return $categoryMedias;
    }
}