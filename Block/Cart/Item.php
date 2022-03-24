<?php Ccc::loadClass('Block_Core_Template'); ?>
<?php
class Block_Cart_Item extends Block_Core_Template
{
	public function __construct()
	{
		$this->setTemplate('view/cart/Item.php');
	}

	public function getCartItem()
	{
		$customerId = Ccc::getFront()->getRequest()->getRequest('id');
		$customer = Ccc::getModel('Customer')->load($customerId);
		$customer = $customer->getCart();
		$cartId = $customer->cartId;
		$cartItem = Ccc::getModel('Cart_Item');
		$cartItem = $cartItem->fetchAll("SELECT ci.itemId,p.name,ci.quantity,p.price,pm.image AS baseImage from cart_item ci LEFT JOIN product p on ci.productId = p.id LEFT join product_media pm on p.id = pm.productId AND (pm.base = 1) WHERE ci.cartId = {$cartId};");

		return $cartItem;
	}

	public function getProducts()
	{
		$productModel = Ccc::getModel('Product');
		$products = $productModel->fetchAll("SELECT p.*,b.image AS baseImage FROM product p LEFT JOIN product_media b ON p.id = b.productId AND (b.base = 1) WHERE p.status = 1;");
		return $products;
	}

	public function getOrder()
	{
		$customerId = Ccc::getFront()->getRequest()->getRequest('id');
		$customer = Ccc::getModel('Customer')->load($customerId);
		$order = $customer->getOrder();
		return $order;
	}
}