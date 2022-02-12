<html>
<head><title>Category Add</title></head>
<body>
	<form  method="POST" action="index.php?c=customer&a=save">
		<table border="1" width="100%" cellspacing="4">

			<!-- this is used for personal data -->
			<tr>
				<td colspan="4"><h1>Customer Details</h1></td>
			</tr>
			
			<tr>
				<td>First Name</td>
				<td><input type="text" name="customer[firstName]"></td>
			</tr>
			
			<tr>
				<td >Last Name</td>
				<td><input type="text" name="customer[lastName]"></td>
			</tr>

			<tr>
				<td >Email</td>
				<td><input type="text" name="customer[email]"></td>
			</tr>

			<tr>
				<td >Phone</td>
				<td><input type="text" name="customer[phone]"></td>
			</tr>
			<!--this is address informatiom-->
			<tr>
				<td colspan="4"><h1>Customer Address</h1></td>
			</tr>

			<tr>
				<td>Address</td>
				<td><input type="text" name="address[address]"></td>
			</tr>
			
			<tr>
				<td >Postal Code</td>
				<td><input type="text" name="address[postalCode]"></td>
			</tr>
			
			<tr>
				<td >City</td>
				<td><input type="text" name="address[city]"></td>
			</tr>
			
			<tr>
				<td >State</td>
				<td><input type="text" name="address[state]"></td>
			</tr>
			
			<tr>
				<td >Country</td>
				<td><input type="text" name="address[country]"></td>
			</tr>
			
			<tr>
				<td>Address Type</td>
				<td>
					<input type="checkbox" id="billing" name="address[billing]" value="1">
					<label for="billing">Billing Address</label><br>
					<input type="checkbox" id="shipping" name="address[shipping]" value="1">
					<label for="shipping">Shipping Address</label><br>
				</td>
			</tr>
			<tr>
				<td >Status</td>
				<td>
					<select name="customer[status]">
						<option value="1">Active</option>
						<option value="2">Inactive</option>
					</select>
				</td>
			</tr>
			
			<tr>
				<td >&nbsp;</td>
				<td>
					<input type="submit" name="submit" value="Save">
					<button type="button"><a href="index.php?c=customer&a=grid">Cancel</a></button>
				</td>
			</tr>
			
		</table>
		<tr>
			<td><input type="hidden" name="customer[id]"></td>
		</tr>

		<tr>
			<td><input type="hidden" name="address[addressId]"></td>
		</tr>

		<tr>
			<td><input type="hidden" name="address[customerId]"></td>
		</tr>
	</form>
</body>
</html>