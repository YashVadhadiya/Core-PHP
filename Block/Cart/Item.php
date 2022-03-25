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
		$cartId = Ccc::getModel('Admin_Message')->getSession()->cartId;
		$cartModel = Ccc::getModel('Cart')->load($cartId);
		$customerId = $cartModel->customerId;
		$customer = Ccc::getModel('Customer')->load($customerId);
		$customer = $customer->getCart();
		$cartId = $customer->cartId;
		$cartItem = Ccc::getModel('Cart_Item');
		return $cartItem->fetchAll("SELECT ci.itemId,p.name,ci.quantity,p.price,pm.image AS baseImage from cart_item ci LEFT JOIN product p on ci.productId = p.id LEFT join product_media pm on p.id = pm.productId AND (pm.base = 1) WHERE ci.cartId = {$cartId};");
	}

	public function getProducts()
	{
		$productModel = Ccc::getModel('Product');
		return $productModel->fetchAll("SELECT p.*,b.image AS baseImage FROM product p LEFT JOIN product_media b ON p.id = b.productId AND (b.base = 1) WHERE p.status = 1;");
	}

	public function getOrder()
	{
		$cartId = Ccc::getModel('Admin_Message')->getSession()->cartId;
		$cartModel = Ccc::getModel('Cart')->load($cartId);
		$customerId = $cartModel->customerId;
		$customer = Ccc::getModel('Customer')->load($customerId);
		return $customer->getOrder();
	}
}