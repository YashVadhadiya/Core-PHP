<?php Ccc::loadClass("Model_Core_Row"); ?>
<?php
class Model_Cart_Address extends Model_Core_Row
{
	protected $cart;

	public function __construct()
	{
		$this->setResourceClassName('Cart_Address_Resource');
		parent::__construct();
	}

	public function getcart($reload = false)
    {
        $cartModel = Ccc::getModel('cart');
        
        if(!$this->cartId)
        {
            return $cartModel;
        }

        if($this->cart && !$reload)
        { 
            return $this->cart;
        }
        $cart = $cartModel->fetchRow("SELECT * from cart WHERE cartId = {$this->cartId}");
        if(!$cart)
        {
            return $cartModel;
        }
        $this->setcart($cart);
        return $cart;
    }

    public function setcart(Model_cart $cart)
    {
        $this->cart = $cart;
        return $this;
    }
}



