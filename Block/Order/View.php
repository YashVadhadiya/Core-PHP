<?php 
Ccc::loadClass('Block_Core_Template');
class Block_Order_View extends Block_Core_Template
{
	public function __construct()
	{

		$this->setTemplate('view/order/view.php');
	}

	public function getOrder()
	{
		$orderModel = Ccc::getModel('Order');
		$orderId = Ccc::getFront()->getRequest()->getRequest('id');
		$order = $orderModel->fetchRow("SELECT * FROM orders WHERE orderId = $orderId");
		return $order;
	}

	public function getOrderAddress()
	{
		$orderModel = Ccc::getModel('Order');
		$orderId = Ccc::getFront()->getRequest()->getRequest('id');
		$orderAddress = $orderModel->fetchRow("SELECT * FROM order_address WHERE orderId = $orderId");
		return $orderAddress;
	}

	public function getOrderItems()
	{
		$orderModel = Ccc::getModel('Order');
		$orderId = Ccc::getFront()->getRequest()->getRequest('id');
		$orderItems = $orderModel->fetchAll("SELECT oi.*, pm.image AS image from order_item oi left join product p on oi.productId = p.id left join product_media pm on p.id = pm.productId WHERE oi.orderId = $orderId;");
		return $orderItems;
	}

	public function getCustomer()
	{
		$orderId = Ccc::getFront()->getRequest()->getRequest('id');
		$orderModel = Ccc::getModel('Order')->load($orderId);
		$customerId = $orderModel->customerId;
		$customer = $orderModel->fetchRow("SELECT * FROM customer WHERE id = $customerId");
		return $customer;
	}

	public function getShippingMethod()
	{
		$orderId = Ccc::getFront()->getRequest()->getRequest('id');
		$orderModel = Ccc::getModel('Order')->load($orderId);
		$shippingMethod = $orderModel->getShippingMethod();
		return $shippingMethod;
	}

	public function getPaymentMethod()
	{
		$orderId = Ccc::getFront()->getRequest()->getRequest('id');
		$orderModel = Ccc::getModel('Order')->load($orderId);
		$paymentMethod = $orderModel->getPaymentMethod();
		return $paymentMethod;
	}

	public function getBillingAddress()
	{
		$orderId = Ccc::getFront()->getRequest()->getRequest('id');
		$orderModel = Ccc::getModel('Order')->load($orderId);
		$billingAddress = $orderModel->getBillingAddress();
		return $billingAddress;
	}

	public function getShippingAddress()
	{
		$orderId = Ccc::getFront()->getRequest()->getRequest('id');
		$orderModel = Ccc::getModel('Order')->load($orderId);
		$shippingAddress = $orderModel->getShippingAddress();
		return $shippingAddress;
	}

	public function getProducts()
	{
		$orderId = Ccc::getFront()->getRequest()->getRequest('id');
		$orderModel = Ccc::getModel('Order')->load($orderId);
		$products = $orderModel->getProducts();
		return $products;
	}

	public function getCartItems()
	{

		$orderId = Ccc::getFront()->getRequest()->getRequest('id');
		$order = Ccc::getModel('Order')->load($orderId);
		$customerId = $order->customerId;
		$customer = Ccc::getModel('Customer')->load($customerId);
		//print_r(); die;
		$customer = $customer->getCart();
		$cartId = $customer->cartId;
		$cartItem = Ccc::getModel('Cart_Item');
		$cartItem = $cartItem->fetchAll("SELECT ci.itemId,p.name,ci.quantity,p.price, ci.discount, ci.taxAmount, pm.image AS baseImage from cart_item ci LEFT JOIN product p on ci.productId = p.id LEFT join product_media pm on p.id = pm.productId AND (pm.base = 1) WHERE ci.cartId = {$cartId};");
		return $cartItem;
	}

	public function getCart()
	{
		$orderId = Ccc::getFront()->getRequest()->getRequest('id');
		$order = Ccc::getModel('Order')->load($orderId);
		$customerId = $order->customerId;
		$cart = Ccc::getModel('Cart');
		$carts = $cart->fetchRow("SELECT * from `cart` WHERE `customerId` = {$customerId};");
		return $carts;
	}
}