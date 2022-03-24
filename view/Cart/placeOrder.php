<?php $cartItems = $this->getCartItems(); ?>
<?php $cart = $this->getCart(); ?>
<?php $totalDiscount = 0; ?>
<?php if ($cartItems): ?>
<?php foreach ($cartItems as $cartItem)
	{
		$totalDiscount = $totalDiscount + $cartItem->discount;
	}
?>
<?php endif;?>


<h2>Order Details</h2>
<form  action="<?php echo $this->getUrl('saveOrder','order') ?>" method="POST">
<table border="1" width="100%" cellspacing="4">
<?php if(!$cartItems):?>
	<tr>
		<th>Sub Total</th>
		<td>0</td>
	</tr>
	<tr>
		<th>Shipping Amount</th>
		<td>0</td>
	</tr>
	<tr>
		<th>Tax</th>
		<td>0</td>
	</tr>
	<tr>
		<th>Discount</th>
		<td>0</td>
	</tr>
	<tr>
		<th>Grand Total</th>
		<td>0</td>
	</tr>
	<?php else:?>
	<tr>
        <th>Sub Total</th>
        <td>
            <?php $total = 0;?>
            <?php foreach ($cartItems as $cartItem) 
            {
            $priceTotal = $cartItem->quantity * $cartItem->price;
            $total = $priceTotal + $total;
            }
            ?>
            <?php echo $total. " ₹";?>
        </td>
    </tr>
    <tr>
        <th>Shipping Amount</th>
        <td>
            <?php echo "+" ." ".$cart->shippingAmount. " ₹"?>
        </td>
    </tr>
    <tr>
        <th>Tax</th>
        <td>
            <?php $taxTotal = 0;?>
            <?php foreach ($cartItems as $cartItem) 
                {
                    $taxTotal = $taxTotal + $cartItem->taxAmount;
                }
                ?>
            <?php echo "+" ." ".$taxTotal. " ₹";?>
        </td>
    </tr>
    <tr>
        <th>Discount</th>
        <td><?php echo "-" ." ".$totalDiscount." ₹" ?></td>
    </tr>
    <tr>
        <th>Grand Total</th>
        <td>
            <?php echo "= " ." ".($total + $cart->shippingAmount + $taxTotal - $totalDiscount). " ₹"; ?>
        </td>
    </tr>
        <?php endif; ?>
        <td></td>
	<td>
		<button type="submit" name="submit">Place Order</button>
		<button type="button"><a href="<?php echo $this->getUrl('grid','cart',null,true) ?>">Cancel</a></button>
	</td>
</table>