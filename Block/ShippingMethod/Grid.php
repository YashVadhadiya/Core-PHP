<?php 

Ccc::loadClass('Block_Core_Template');
class Block_ShippingMethod_Grid extends Block_Core_Template
{
	public $pager;

	public function __construct()
	{
		$this->setTemplate('view/shippingMethod/grid.php');
	}

	public function getShippingMethods()
	{
		$shippingMethod = Ccc::getFront()->getRequest()->getRequest('p',1);
		$perPageCount = Ccc::getFront()->getRequest()->getRequest('rpp',10);
		$pager = Ccc::getModel('Core_Pager');
		$this->setPager($pager);
		$shippingMethodModel = Ccc::getModel('ShippingMethod');
		$totalCount = $shippingMethodModel->getAdapter()->fetchOne("SELECT count('shippingMethodId') FROM `shipping_method`");
		$this->getPager()->execute($totalCount,$shippingMethod);
		$shippingMethods = $shippingMethodModel->fetchAll("SELECT * FROM `shipping_method` LIMIT {$this->getPager()->getStartLimit()},{$perPageCount}");
		return $shippingMethods;
	}
}
