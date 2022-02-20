<?php $customer = $this->getCustomer(); ?>
<?php $urlAction = new Controller_Core_Action();?>
<html>
<head><title>Category Update</title></head>
<body>
	<form method="POST" action="<?php echo$urlAction->getUrl('save','customer',['id' =>  $customer['id']],true) ?>">
		<table border="1" width="100%" cellspacing="4">

			<!-- this is used for personal data -->
			<tr>
				<td colspan="4"><h1>Personal details</h1></td>
			</tr>

			<tr>
				<td >Id</td>
				<td><input type="text" name="customer[id]" value="<?php echo $customer['id']; ?>" readonly></td>
			</tr>	
			<tr>
				<td >First Name</td>
				<td><input type="text" name="customer[firstName]" value="<?php echo $customer['firstName'] ?>"></td>
			</tr>
			
			<tr>
				<td >Last Name</td>
				<td><input type="text" name="customer[lastName]"  value="<?php echo $customer['lastName'] ?>"></td>
			</tr>

			<tr>
				<td >Email</td>
				<td><input type="text" name="customer[email]"  value="<?php echo $customer['email'] ?>"></td>
			</tr>

			<tr>
				<td >Phone</td>
				<td><input type="text" name="customer[phone]" value="<?php echo $customer['phone'] ?>"></td>
			</tr>
			<tr>
				<td colspan="4"><h1>Customer Address</h1></td>
			</tr>
			<tr>
				<td >Id</td>
				<td><input type="text" name="address[id]" value="<?php echo $customer['addressId']; ?>" readonly></td>
			</tr>	
			<tr>
				<td>Address</td>
				<td><input type="text" name="address[address]"  value="<?php echo $customer['address'] ?>"></td>
			</tr>
			<tr>
				<td >Postal Code</td>
				<td><input type="text" name="address[postalCode]"  value="<?php echo $customer['postalCode'] ?>"></td>
			</tr>
			<tr>
				<td >City</td>
				<td><input type="text" name="address[city]"  value="<?php echo $customer['city'] ?>"></td>
			</tr>
			<tr>
				<td >State</td>
				<td><input type="text" name="address[state]"  value="<?php echo $customer['state'] ?>"></td>
			</tr>
			<tr>
				<td>Country</td>
				<td><input type="text" name="address[country]" value="<?php echo $customer['country'] ?>"></td>
			</tr>
			<tr>
				<td>Address Type</td>
				<td>
					<input type="checkbox" id="billing" name="address[billing]" value="1" <?php if($customer['billing'] == 1): ?> checked <?php endif; ?>>
					<label for="billing">Billing Address</label><br>
					<input type="checkbox" id="shipping" name="address[shipping]" value="1" <?php if($customer['shipping'] == 1): ?> checked <?php endif; ?>>
					<label for="shipping">Shipping Address</label><br>
				</td>
			</tr>

			<tr>
				<td >Status</td>
				<td>
					<select name="customer[status]">
						<option value="1" <?php if($customer['status'] == 1): ?> selected = "selected" <?php endif; ?>>Active</option>
                        <option value="2" <?php if($customer['status'] == 2): ?> selected = "selected" <?php endif; ?>>Inactive</option>
					</select>
				</td>
			</tr>
			
			<tr>
				<td >&nbsp;</td>
				<td>
					<input type="submit" value="Edit" name="edit">
					<button type="button"><a href="<?php echo $urlAction->getUrl('grid','customer',null,true) ?>">Cancel</a></button>
				</td>
			</tr>
			
		</table>	
	</form>
</body>
</html>