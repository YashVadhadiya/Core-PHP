<?php Ccc::loadClass('Block_Core_Template'); ?>
<?php
class Block_Cart_Grid extends Block_Core_Template
{
	public function __construct()
	{
		$this->setTemplate('view/cart/grid.php');
	}

	public function getCarts()
	{
		$page = Ccc::getFront()->getRequest()->getRequest('p',1);
		$perPageCount = Ccc::getFront()->getRequest()->getRequest('ppr',10);
		$pager = Ccc::getModel('Core_Pager');
		$this->setPager($pager);
		$cartModel = Ccc::getModel('cart');
		$totalCount = $cartModel->getAdapter()->fetchOne("SELECT count('cartId') FROM cart");
		$this->getPager()->execute($totalCount, $page);
		$carts = $cartModel->fetchAll("SELECT * FROM cart LIMIT {$this->getPager()->getStartLimit()},{$perPageCount}");
		return $carts;
	}
}