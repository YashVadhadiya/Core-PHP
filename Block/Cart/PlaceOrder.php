<?php Ccc::loadClass('Block_Core_Template'); ?>
<?php
class Block_Cart_PlaceOrder extends Block_Core_Template
{
	public function __construct()
	{
		$this->setTemplate('view/cart/PlaceOrder.php');
	}

	public function getCartItems()
	{
		$customerId = Ccc::getFront()->getRequest()->getRequest('id');
		$customer = Ccc::getModel('Customer')->load($customerId);
		$customer = $customer->getCart();
		$cartId = $customer->cartId;
		$cartItem = Ccc::getModel('Cart_Item');
		$cartItem = $cartItem->fetchAll("SELECT ci.itemId,p.name,ci.quantity,p.price, ci.discount, ci.taxAmount, pm.image AS baseImage from cart_item ci LEFT JOIN product p on ci.productId = p.id LEFT join product_media pm on p.id = pm.productId AND (pm.base = 1) WHERE ci.cartId = {$cartId};");
		return $cartItem;
	}

	public function getCart()
	{
		$customerId = Ccc::getFront()->getRequest()->getRequest('id');
		$cart = Ccc::getModel('Cart');
		$carts = $cart->fetchRow("SELECT * from `cart` WHERE `customerId` = {$customerId};");
		return $carts;
	}
}