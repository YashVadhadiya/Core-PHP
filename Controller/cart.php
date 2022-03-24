<?php Ccc::loadClass('Controller_Core_Action'); ?>
<?php Ccc::loadClass('Model_Core_Request'); ?>
<?php

class Controller_Cart extends Controller_Core_Action
{
	public function gridAction()
	{
		$this->setTitle("Cart Grid");
		$content = $this->getLayout()->getContent();
        $cartGrid = Ccc::getBlock("Cart_Grid");
        $content->addChild($cartGrid);
        $this->renderLayout();
	}

	public function addAction()
	{
		$content = $this->getLayout()->getContent();
		$customerModel = Ccc::getModel('Cart');
		$customers = $customerModel->getCustomers();
		$cartAdd = Ccc::getBlock("Cart_Add")->setData(['customers' => $customers]);
		$content->addChild($cartAdd);
        $this->renderLayout();
	}

	public function cartCheckAction()
	{
		try 
		{
			$message = $this->getMessage();
			$date = date("Y-m-d H:i:s");

			$customerId = $this->getRequest()->getRequest('id');
			if(!$customerId)
			{
				throw new Exception("Invalid Request");
			}
			$customer = Ccc::getModel('Customer')->load($customerId);
			if(!$customer)
			{
				throw new Exception("Unable to load Data");
			}

			$cartModel = $customer->getCart();
			if(!$cartModel)
			{
				$cartModel = Ccc::getModel('Cart');
				$cartModel->customerId = $customerId;
				$cartModel->createdAt = $date;
			}
			$result = $cartModel->save();
			$cart = Ccc::getModel('Cart')->fetchRow("SELECT * FROM `cart` WHERE `cartId` = '{$result->cartId}'");
			Ccc::getModel('Admin_Session')->cart = $cart;
			
			$message->addMessage('Update Successfully'); 
            $this->redirect($this->getLayout()->getUrl('cartShow','cart',null,false));
		} 
		catch (Exception $e) 
		{
			$message->addMessage($e->getMessage(),Model_Core_Message::ERROR);
			$this->redirect($this->getLayout()->getUrl('cartShow','cart',null,false));
		}
	}

	public function cartShowAction()
	{
		try 
		{
			$message = $this->getMessage();
			$customerId = $this->getRequest()->getRequest('id');
			if(!$customerId)
			{
				throw new Exception("Invalid Request");
			}
			
			$this->setTitle("Cart");
			$content = $this->getLayout()->getContent();
			$customer = Ccc::getModel('Customer');
	    	$customerDetails = Ccc::getBlock('Cart_CustomerDetails');
	    	$shippingMethod = Ccc::getBlock('Cart_ShippingMethod');
	    	$paymentMethod = Ccc::getBlock('Cart_PaymentMethod');
	    	$address = Ccc::getBlock('Cart_Address');
	    	$cartItem = Ccc::getBlock('Cart_Item');
	    	$PlaceOrder = Ccc::getBlock('Cart_PlaceOrder');
	      	$content->addChild($customerDetails);
	      	$content->addChild($shippingMethod);
	      	$content->addChild($paymentMethod);
	      	$content->addChild($address);
	      	$content->addChild($cartItem);
	      	$content->addChild($PlaceOrder);
	      	$this->renderLayout();	
		} 
		catch (Exception $e) 
		{
			$message->addMessage($e->getMessage(),Model_Core_Message::ERROR);
			$this->redirect($this->getLayout()->getUrl('cartShow','cart',null,false));
		}
	}

	public function updatePaymentMethodAction()
	{
		try 
		{
			$message = $this->getMessage();
			$paymentMethodId = $this->getRequest()->getPost('paymentMethod');
			$customerId = $this->getRequest()->getRequest('id');
			if(!$customerId)
			{
				throw new Exception("Invalid Request");
			}
			$customer = Ccc::getModel('Customer')->load($customerId);
			if(!$customer)
			{
				throw new Exception("Unable to load Data");
			}
			$cartModel = $customer->getCart();
			$cartModel->paymentMethodId = $paymentMethodId;
			$cartModel->save();
			$message->addMessage('Update Successfully.');
			$this->redirect($this->getLayout()->getUrl('cartShow','cart',null,false));
		} 
		catch (Exception $e) 
		{
			$message->addMessage($e->getMessage(),Model_Core_Message::ERROR);
			$this->redirect($this->getLayout()->getUrl('cartShow','cart',null,false));
		}
	}

	public function updateShippingMethodAction()
	{
		try 
		{
			$message = $this->getMessage();
			$shippingMethodId = $this->getRequest()->getPost('shippingMethod');
			if(!$shippingMethodId)
			{
				throw new Exception("Invalid Request");
			}
			$customerId = $this->getRequest()->getRequest('id');
			if(!$customerId)
			{
				throw new Exception("Invalid Request");
			}
			$customer = Ccc::getModel('Customer')->load($customerId);
			if(!$customer)
			{
				throw new Exception("Unable to load Data");
			}
			$cartModel = $customer->getCart();
			$shippingAmount = $this->getAdapter()->fetchOne("SELECT price from shipping_method where methodId = {$shippingMethodId};");
			if(!$shippingAmount)
			{
				throw new Exception("Unable to load Data");
			}
			$cartModel->shippingMethodId = $shippingMethodId;
			$cartModel->shippingAmount = $shippingAmount;
			$cartModel->save();
			$message->addMessage('Update Successfully.');
			$this->redirect($this->getLayout()->getUrl('cartShow','cart',null,false));
		} 
		catch (Exception $e) 
		{
			$message->addMessage($e->getMessage(),Model_Core_Message::ERROR);
			$this->redirect($this->getLayout()->getUrl('cartShow','cart',null,false));
		}
		
	}

	public function saveAddressAction()
	{
		try 
		{
			$message = $this->getMessage();
			$postData = $this->getRequest()->getPost();
			if(!$postData)
			{
				throw new Exception("Invalid Request");
			}
			$billingRow = $this->getRequest()->getPost('billingAddress');
			$customerBillingRow = $this->getRequest()->getPost('customerBilling');
			if(!$billingRow)
			{
				throw new Exception("Invalid Request");
			}
	        $shippingRow = (array_key_exists('same', $this->getRequest()->getPost())) ? $billingRow : $this->getRequest()->getPost('shippingAddress'); 
	        $customerShippingRow = (array_key_exists('same', $this->getRequest()->getPost())) ? $customerBillingRow : $this->getRequest()->getPost('customerShipping'); 
	        if(!$shippingRow)
			{
				throw new Exception("Invalid Request");
			}
			$customerId = $this->getRequest()->getRequest('id');
			if(!$customerId)
			{
				throw new Exception("Invalid Request");
			}
			$customer = Ccc::getModel('Customer')->load($customerId);
			if(!$customer)
			{
				throw new Exception("Unable to load Data");
			}
			$billingAddressModel = $customer->getBillingAddress();
			$shippingAddressModel = $customer->getShippingAddress();

			$cartModel = $customer->getCart();
			$cartBillingAddress = $cartModel->getBillingAddress(true);
			$cartShippingAddress = $cartModel->getShippingAddress(true);
			$cartId = $cartModel->cartId;
			
			$cartBillingAddress->setData($billingRow); 
			$cartBillingAddress->setData($customerBillingRow); 
			$cartBillingAddress->cartId = $cartId;
			$cartBillingAddress->billing = 1;
			$cartBillingAddress->shipping = 0;
			$cartBillingAddress->same = (array_key_exists('same', $this->getRequest()->getPost())) ? 1 : 0;
			$cartBillingAddress->save();


			$cartShippingAddress->setData($shippingRow);
			$cartShippingAddress->setData($customerShippingRow); 
			$cartShippingAddress->cartId = $cartId;
			$cartShippingAddress->billing = 0;
			$cartShippingAddress->shipping = 1;
			$cartShippingAddress->same = (array_key_exists('same', $this->getRequest()->getPost())) ? 1 : 0;
			$cartShippingAddress->save();


			if(array_key_exists('billingAddressBook',$postData))
			{
				$billingAddressModel->setData($billingRow);
				$billingAddressModel->save();
			}

			if(array_key_exists('shippingAddressBook',$postData))
			{
				$shippingAddressModel->setData($shippingRow);
				$shippingAddressModel->save();
			}
			$message->addMessage('Update Successfully.');
			$this->redirect($this->getLayout()->getUrl('cartShow','cart',null,false));
		} 
		catch (Exception $e) 
		{
			$message->addMessage($e->getMessage(),Model_Core_Message::ERROR);
			$this->redirect($this->getLayout()->getUrl('cartShow','cart',null,false));	
		}
		
	}

	public function addProductAction()
	{
		try 
		{
			$message = $this->getMessage();
			$postData = $this->getRequest()->getPost();
			if (!$postData) 
			{	
				throw new Exception("Invalid Request.");
			}
			$ids = $postData['selected'];
			$quantities = $postData['quantity'];
			$customerId = $this->getRequest()->getRequest('id');
			if (!$customerId) 
			{	
				throw new Exception("Invalid Request.");
			}
			$customer = Ccc::getModel('Customer')->load($customerId);
			if(!$customer)
			{
				throw new Exception("Unable to load Data");
			}
			$customer = $customer->getCart();
			$cartId = $customer->cartId;

			foreach ($quantities as $key => $value) 
			{
				foreach ($ids as $id) 
				{
					if($key == $id)
					{
						$productModel = Ccc::getModel('Product')->load($id);
						$cartItemModel = Ccc::getModel('Cart_Item');
						$cartItemModel->cartId = $cartId;
						$cartItemModel->productId = $id;
						$cartItemModel->quantity = $value;

						$discount = $productModel->discount;
						if($productModel->discountMode == 2)
						{
							$discount = ($productModel->price * $productModel->discount) / 100;
						}

				//print_r($value * $discount); die;
						$cartItemModel->cost = $productModel->cost;
						$cartItemModel->price = $productModel->price;
						$cartItemModel->discount = $discount * $value;
						$cartItemModel->tax = $productModel->tax;
						$cartItemModel->taxAmount = (($productModel->price * $productModel->tax)/100) * $value;
						$cartItemModel->save();
					}
				}
			}	
			$message->addMessage('Product Added Successfully.');
			$this->redirect($this->getLayout()->getUrl('cartShow','cart',null,false));	
		} 
		catch (Exception $e) 
		{
			$message->addMessage($e->getMessage(),Model_Core_Message::ERROR);
			$this->redirect($this->getLayout()->getUrl('cartShow','cart',null,false));	
		}	
	}	

	public function removeProductAction()
	{
		try 
		{
			$this->setTitle("Item Delete");
			$message = $this->getMessage();
			$id = $this->getRequest()->getRequest('itemId'); 
			$itemTable = Ccc::getModel('Cart_Item')->load($id);	
			if (!$id) 
			{	
				throw new Exception("Invalid Request.");
			}
			$delete = $itemTable->delete(['itemId' => $id]);
			if(!$delete)
			{
				throw new Exception("System is unable to delete record.");			
			}
			$message->addMessage('Delete Successfully.');			
			$this->redirect($this->getLayout()->getUrl('cartShow',null,['itemId' => null],false));			
		} 
		catch (Exception $e) 
		{
			$message->addMessage($e->getMessage(),Model_Core_Message::ERROR);
			$this->redirect($this->getLayout()->getUrl($this->getUrl('cartShow',null,['itemId' => null],false)));	
		}
	}

	public function updateItemAction()
    {
        $message = $this->getMessage();
        try 
        {
            $customerId = $this->getRequest()->getRequest('id');
            $itemIds = $this->getRequest()->getPost('quantity');

            foreach ($itemIds as $itemId => $quantity) 
            {
                $cartItemModel = Ccc::getModel('Cart_Item')->load($itemId);
                $cartItemModel->quantity = $quantity;
                $cartItemModel->save();
            }

            $message->addMessage('Data Saved.');
            $this->redirect($this->getLayout()->getUrl('cartShow', 'cart', null, false));
        } 
        catch (Exception $e) 
        {
            $message->addMessage($e->getMessage(),Model_Core_Message::ERROR);
            $this->redirect($this->getLayout()->getUrl('cartShow','cart',null,false));
        }
    }
}