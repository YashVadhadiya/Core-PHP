<?php $cartItems = $this->getCartItems(); ?>
<?php $cart = $this->getCart(); ?>
<?php $totalDiscount=0; ?>
<?php if($cartItems): ?>
    <?php foreach ($cartItems as $cartItem)
    {
        $totalDiscount = $totalDiscount + $cartItem->discount * $cartItem->quantity;
    } 
    ?>
<?php endif;?>

<h2>Order Details</h2>
<table id="example2" class="table table-bordered table-hover">

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
                    $mul = $cartItem->quantity * $cartItem->price;
                    $total = $mul + $total;
                }
                ?>
                <?php echo $total . "" .' ₹' ;?>
            </td>
        </tr>
        <tr>
            <th>Shipping Amount</th>
            <td>
                <?php echo $cart->shippingAmount . "" .' ₹'?>
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
                <?php echo $taxTotal . "" .' ₹';?>
            </td>
        </tr>
        <tr>
            <th>Discount</th>
            <td><?php echo $totalDiscount . "" .' ₹'; ?></td>
        </tr>
        <tr>
            <th>Grand Total</th>
            <td>
                <?php echo (($total + $cart->shippingAmount + $taxTotal) - $totalDiscount) . "" .' ₹';?>
            </td>
        </tr>
    <?php endif; ?>
    <td></td>
    <td>
        <button class="btn btn-success" type="button" onclick="placeOrder()">Place Order</button>
    </td>
</table>



<script type="text/javascript">
    function placeOrder() 
    {
        //alert('button clicked');
        admin.setForm(jQuery('#indexForm'));
        admin.setUrl("<?php echo $this->getUrl('saveOrder','order') ?>");
        admin.load();
    }
</script>

