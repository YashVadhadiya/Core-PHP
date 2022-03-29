<?php $billingAddress = $this->getBillingAddress();?>
<?php $shippingAddress = $this->getShippingAddress(); ?>

<table border="1" width="100%" cellspacing="4">

<tr>
	<td colspan="4"><h1>Billing Address</h1></td>
</tr>
	
<tr>
	<td>Address</td>
	<td><input type="text" id="billingAddress" name="billingAddress[address]"  value="<?php echo $billingAddress->address ?>"></td>
</tr>
<tr>
	<td >Postal Code</td>
	<td><input type="text" id="billingPostalCode" name="billingAddress[postalCode]"  value="<?php echo $billingAddress->postalCode ?>"></td>
</tr>
<tr>
	<td >City</td>
	<td><input type="text" id="billingCity" name="billingAddress[city]"  value="<?php echo $billingAddress->city ?>"></td>
</tr>
<tr>
	<td >State</td>
	<td><input type="text" id="billingState" name="billingAddress[state]"  value="<?php echo $billingAddress->state ?>"></td>
</tr>
<tr>
	<td>Country</td>
	<td><input type="text" id="billingCountry" name="billingAddress[country]" value="<?php echo $billingAddress->country ?>"></td>
</tr>

<tr>
<td colspan="2"><input type="checkbox" name="sameShipping" <?php if($billingAddress->same == 1):?> checked <?php endif; ?> onclick="showHide(this)">Mark Shipping as Billing</td>
</tr>
</table>


<script type="text/javascript">
function showHide(checkbox) {
	var shippingAddress = document.getElementById('shipping');
	shippingAddress.style.display = checkbox.checked ? "none" : "block";
}
</script>

<div id='shipping' <?php if($billingAddress->same != 1): ?> style="display:block;" <?php else: ?> style="display:none;" <?php endif; ?>>
<table border="1" width="100%" cellspacing="4">


<tr>
	<td colspan="4"><h1>Shipping Address</h1></td>
</tr>
	
<tr>
	<td>Address</td>
	<td><input type="text" id="shippingAddress" name="shippingAddress[address]"  value="<?php echo $shippingAddress->address ?>"></td>
</tr>
<tr>
	<td >Postal Code</td>
	<td><input type="text" id="shippingPostalCode" name="shippingAddress[postalCode]"  value="<?php echo $shippingAddress->postalCode ?>"></td>
</tr>
<tr>
	<td >City</td>
	<td><input type="text" id="shippingCity" name="shippingAddress[city]"  value="<?php echo $shippingAddress->city ?>"></td>
</tr>
<tr>
	<td >State</td>
	<td><input type="text" id="shippingState" name="shippingAddress[state]"  value="<?php echo $shippingAddress->state ?>"></td>
</tr>
<tr>
	<td>Country</td>
	<td><input type="text" id="shippingCountry" name="shippingAddress[country]" value="<?php echo $shippingAddress->country ?>"></td>
</tr>

<tr>
	<td >&nbsp;</td>
	<td>
	</td>
</tr>

</table>
</div>
<button type="submit">Save</button>
<button type="button"><a href="<?php echo $this->getUrl('grid','customer',null,true) ?>">Cancel</a></button>