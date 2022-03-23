<?php $shippingMethods = $this->getShippingMethods(); ?>
<?php $cart = $this->getCart(); ?>

<h2>Choose Shipping Method<h2>
<form action="<?php echo $this->getUrl('updateShippingMethod') ?>" method="POST">
<table border="1" width="100%" cellspacing="4">

<?php foreach ($shippingMethods as $shippingMethod):?>
    <tr>
        <td><?php echo $shippingMethod->name?></td>
        <td><?php echo $shippingMethod->price?></td>
        <td><input type="radio" name="shippingMethod" value="<?php echo $shippingMethod->methodId?>" <?php echo ($cart->shippingMethodId == $shippingMethod->methodId) ? 'checked' : '' ; ?>>
        </td>
    </tr>
<?php endforeach; ?>  
<tr> 
    <td>
        <button type="submit" name="submit" >Update</button>
    </td>     
</tr>    
</table>
</form>