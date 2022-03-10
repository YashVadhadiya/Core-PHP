<?php 

Ccc::loadClass('Block_Core_Template');
class Block_Salesman_Customer_Grid extends Block_Core_Template
{
	public function __construct()
	{
		$this->setTemplate('view/salesman/customer/grid.php');
	}

	public function getCustomerWithoutSalesman()
	{	
		$request = Ccc::getFront();
		$id = $request->getRequest()->getRequest('id');
		$salesmanCustomer = Ccc::getModel('Customer');
		$salesmanCustomers = $salesmanCustomer->fetchAll("SELECT * FROM customer WHERE salesmanId is null");
		return $salesmanCustomers;
	}

	public function getSalesmanCustomers()
	{	
		$request = Ccc::getFront();
		$id = $request->getRequest()->getRequest('id');
		$salesmanCustomer = Ccc::getModel('Customer');
		$salesmanCustomers = $salesmanCustomer->fetchAll("SELECT * FROM customer WHERE salesmanId = $id");
		return $salesmanCustomers;
	}
}