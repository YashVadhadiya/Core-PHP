<?php $vendor = $this->getVendor(); ?>
<?php $urlAction = new Controller_Core_Action();?>
<html>
<head><title>Vendor Edit</title></head>
<body>
	<form method="POST" action="<?php echo$urlAction->getUrl('save','vendor',['id' =>  $vendor->vendorId],true) ?>">
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
				<td><input type="text" name="vendor[email]"  value="<?php echo $vendor->email ?>"></td>
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
				<td><input type="text" name="address[vendorAddressId]" value="<?php echo $vendor->vendorAddressId ?>" readonly></td>
			</tr>	
			<tr>
				<td>Address</td>
				<td><input type="text" name="address[address]"  value="<?php echo $vendor->address ?>"></td>
			</tr>
			<tr>
				<td >Postal Code</td>
				<td><input type="text" name="address[postalCode]"  value="<?php echo $vendor->postalCode ?>"></td>
			</tr>
			<tr>
				<td >City</td>
				<td><input type="text" name="address[city]"  value="<?php echo $vendor->city ?>"></td>
			</tr>
			<tr>
				<td >State</td>
				<td><input type="text" name="address[state]"  value="<?php echo $vendor->state ?>"></td>
			</tr>
			<tr>
				<td>Country</td>
				<td><input type="text" name="address[country]" value="<?php echo $vendor->country ?>"></td>
			</tr>
			<tr>
				<td >Status</td>
				<td>
					<select name="vendor[status]">
						<?php if($vendor->status == 2): ?>
				              <option value='2'>InActive</option>
				              <option value='1'>Active</option>
				          	<?php else: ?>
				              <option value='1'>Active</option>
				              <option value='2'>InActive</option>
				          	<?php endif;?>
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
</body>
</html>