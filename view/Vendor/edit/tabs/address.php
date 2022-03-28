<?php $address = $this->getVendorAddress(); ?>

<table border="1" width="100%" cellspacing="4">
<tr>
	<td colspan="4"><h1>Vendor Address</h1></td>
</tr>
<tr>
	<td >Id</td>
	<td><input type="text" name="address[vendorAddressId]" value="<?php echo $address->vendorAddressId ?>" readonly></td>
</tr>	
<tr>
	<td>Address</td>
	<td><input type="text" name="address[address]"  value="<?php echo $address->address ?>"></td>
</tr>
<tr>
	<td >Postal Code</td>
	<td><input type="text" name="address[postalCode]"  value="<?php echo $address->postalCode ?>"></td>
</tr>
<tr>
	<td >City</td>
	<td><input type="text" name="address[city]"  value="<?php echo $address->city ?>"></td>
</tr>
<tr>
	<td >State</td>
	<td><input type="text" name="address[state]"  value="<?php echo $address->state ?>"></td>
</tr>
<tr>
	<td>Country</td>
	<td><input type="text" name="address[country]" value="<?php echo $address->country ?>"></td>
</tr>

<tr>
	<td >&nbsp;</td>
	<td>
<!-- 		<input type="submit" value="Edit" name="edit">-->		
<button type="submit">Save</button>
<button type="button"><a href="<?php echo $this->getUrl('grid','vendor',null,true) ?>">Cancel</a></button>
	</td>
</tr>

</table>
