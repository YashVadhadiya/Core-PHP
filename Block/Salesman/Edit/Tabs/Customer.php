<?php

Ccc::loadClass('Block_Core_Edit_Tabs_Content');
Ccc::loadClass('Block_Salesman_Edit_Tab');

class Block_Salesman_Edit_Tabs_Customer extends Block_Core_Edit_Tabs_Content
{
	public function __construct()
	{
		$this->setTemplate('view/salesman/edit/tabs/customer.php');
	}

	public function getCustomer()
	{
		return Ccc::getRegistry('customer');
	}

	public function getSalesmanWithCustomer()
	{	
		$request = Ccc::getFront();
		$id = $request->getRequest()->getRequest('id');
		$salesmanCustomer = Ccc::getModel('Customer');
		$salesmanCustomers = $salesmanCustomer->fetchAll("SELECT * FROM `customer` WHERE `salesmanId` = {$id}");
		return $salesmanCustomers;
	}

	public function getSalesmanWithoutCustomer()
	{	
		$request = Ccc::getFront();
		$id = $request->getRequest()->getRequest('id');
		$salesmanCustomer = Ccc::getModel('Customer');
		$salesmanCustomers = $salesmanCustomer->fetchAll("SELECT * FROM `customer` WHERE `salesmanId` is null");
		return $salesmanCustomers;
	}

}