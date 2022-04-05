<?php
Ccc::loadClass('Block_Core_Edit_Tabs_Content');
Ccc::loadClass('Block_Salesman_Edit_Tab');

class Block_Salesman_Edit_Tabs_Price extends Block_Core_Edit_Tabs_Content
{
	public function __construct()
	{
		$this->setTemplate('view/salesman/edit/tabs/price.php');
	}

	public function getProducts()
	{
		$products = Ccc::getModel('Product')->fetchAll("SELECT * FROM `product`");
		$salesmanId = (int)Ccc::getFront()->getRequest()->getRequest('id');
		$percentage = Ccc::getModel('Salesman')->getAdapter()->fetchOne("SELECT `percentage` FROM `salesman` WHERE `salesmanId` = {$salesmanId}");
		return ['products' => $products, 'percentage' => $percentage];
	}

	public function getPrices()
	{
		$customerId = (int)Ccc::getFront()->getRequest()->getRequest('customerId');
		$prices = Ccc::getModel('Customer_Price')->getAdapter()->fetchPairs("SELECT `productId`,`customerPrice` FROM `customer_price` WHERE `customerId` = {$customerId}");
		return $prices;
	}
}



