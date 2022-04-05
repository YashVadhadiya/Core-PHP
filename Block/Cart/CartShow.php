<?php Ccc::loadClass('Block_Core_Template'); ?>
<?php
class Block_Cart_CartShow extends Block_Core_Template
{
	public function __construct()
	{
		$this->setTemplate('view/cart/cartShow.php');
	}
}