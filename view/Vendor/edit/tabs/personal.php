<?php $vendor = $this->getVendor(); ?>
<script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
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
			<button type="submit">Save & Next</button>
			<button type="button"><a href="<?php echo $this->getUrl('grid','vendor',null,true) ?>">Cancel</a></button>
		</td>
	</tr>
	
</table>	
