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
		$cartId = Ccc::getModel('Admin_Message')->getSession()->cartId;
		$cartModel = Ccc::getModel('Cart')->load($cartId);
		$customerId = $cartModel->customerId;
		$customer = Ccc::getModel('Customer')->load($customerId);
		$customer = $customer->getCart();
		$cartId = $customer->cartId;
		$cartItem = Ccc::getModel('Cart_Item');
		return $cartItem->fetchAll("SELECT ci.itemId,p.name,ci.quantity,p.price, ci.discount, ci.taxAmount, pm.image AS baseImage from cart_item ci LEFT JOIN product p on ci.productId = p.id LEFT join product_media pm on p.id = pm.productId AND (pm.base = 1) WHERE ci.cartId = {$cartId};");
	}

	public function getCart()
	{
		$cartId = Ccc::getModel('Admin_Message')->getSession()->cartId;
		$cartModel = Ccc::getModel('Cart')->load($cartId);
		$customerId = $cartModel->customerId;
		$cart = Ccc::getModel('Cart');
		return $cart->fetchRow("SELECT * from `cart` WHERE `customerId` = {$customerId};");
	}
}