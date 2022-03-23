<?php $paymentMethods = $this->getPaymentMethods(); ?>
<?php $cart = $this->getCart(); ?>

<h2>Choose Payment Method<h2>
<form action="<?php echo $this->getUrl('updatePaymentMethod') ?>" method="POST">
<table border="1" width="100%" cellspacing="4">
<?php foreach ($paymentMethods as $paymentMethod):?>
	<tr>
	<td><?php echo $paymentMethod->name?></td>
		<td>
		<input type="radio" name="paymentMethod" value="<?php echo $paymentMethod->methodId ?>"<?php echo ($cart->paymentMethodId == $paymentMethod->methodId) ? 'checked' : '' ; ?>>
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