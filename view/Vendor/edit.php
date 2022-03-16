<?php $vendorAddress = $this->getVendor(); ?>
<?php $urlAction = new Controller_Core_Action();?>

<?php $vendor = $vendorAddress['vendor']; //print_r($vendor);?>
<?php $address = $vendorAddress['vendorAddress']; //print_r($vendorAddress); die;?>

	<form method="POST" action="<?php echo $urlAction->getUrl('save','vendor',null, false) ?>">
		<table border="1" width="100%" cellspacing="4">

			<!-- this is used for personal data -->
			<tr>
				<td colspan="4"><h1>Personal details</h1></td>
			</tr>

			<tr>
				<td >Id</td>
				<td><input type="text" name="vendor[vendorId]" value="<?php echo $vendor->vendorId ?>" readonly></td>
			</tr>	
			<tr>
				<td >First Name</td>
				<td><input type="text" name="vendor[firstName]" value="<?php echo $vendor->firstName ?>"></td>
			</tr>
			
			<tr>
				<td >Last Name</td>
				<td><input type="text" name="vendor[lastName]"  value="<?php echo $vendor->lastName ?>"></td>
			</tr>

			<tr>
				<td >Email</td>
				<td><input type="mail" name="vendor[email]"  value="<?php echo $vendor->email ?>"></td>
			</tr>

			<tr>
				<td >Phone</td>
				<td><input type="text" name="vendor[phone]" value="<?php echo $vendor->phone ?>"></td>
			</tr>
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
				<td >Status</td>
				<td>
					<select name="vendor[status]">
						<?php foreach ($vendor->getStatus() as $key => $value): ?>
              			<option <?php if($vendor->status == $key): ?> selected <?php endif; ?> value="<?php echo $key; ?>"> <?php echo $value; ?></option>
            				<?php endforeach; ?>
					</select>
				</td>
			</tr>
			
			<tr>
				<td >&nbsp;</td>
				<td>
					<input type="submit" value="Edit" name="edit">
					<button type="button"><a href="<?php echo $urlAction->getUrl('grid','vendor',null,true) ?>">Cancel</a></button>
				</td>
			</tr>
			
		</table>	
	</form>