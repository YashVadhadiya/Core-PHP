<?php 
require_once ('Adapter.php');
$adapter = new Adapter();
$id = $_GET['id'];
$customers = $adapter->fetchAll("SELECT c.*, a.* from customer c left join address a on c.id = a.customerId WHERE c.id = $id");
$r = mysqli_fetch_assoc($customers);
?>

<html>
<head><title>Category Update</title></head>
<body>
<form method="POST" action="index.php?a=saveAction&id=<?php echo $_GET['id']?>">
	<table border="1" width="100%" cellspacing="4">

	<!-- this is used for personal data -->
		<tr>
			<td colspan="4"><h1>Personal details</h1></td>
		</tr>

		<tr>
			<td >Id</td>
			<td><input type="text" name="customer[id]" value="<?php echo $r['id']; ?>"></td>
		</tr>	
		<tr>
			<td >First Name</td>
			<td><input type="text" name="customer[firstName]" value="<?php echo $r['firstName'] ?>"></td>
		</tr>
		
		<tr>
			<td >Last Name</td>
			<td><input type="text" name="customer[lastName]"  value="<?php echo $r['lastName'] ?>"></td>
		</tr>

		<tr>
			<td >Email</td>
			<td><input type="text" name="customer[email]"  value="<?php echo $r['email'] ?>"></td>
		</tr>

		<tr>
			<td >Phone</td>
			<td><input type="text" name="customer[phone]" value="<?php echo $r['phone'] ?>"></td>
		</tr>
		<tr>
			<td colspan="4"><h1>Customer Address</h1></td>
		</tr>
		<tr>
			<td>Address</td>
			<td><input type="text" name="address[address]"  value="<?php echo $r['address'] ?>"></td>
		</tr>
		<tr>
			<td >Postal Code</td>
			<td><input type="text" name="address[postalCode]"  value="<?php echo $r['postalCode'] ?>"></td>
		</tr>
		<tr>
			<td >City</td>
			<td><input type="text" name="address[city]"  value="<?php echo $r['city'] ?>"></td>
		</tr>
		<tr>
			<td >State</td>
			<td><input type="text" name="address[state]"  value="<?php echo $r['state'] ?>"></td>
		</tr>
		<tr>
			<td>Country</td>
			<td><input type="text" name="address[country]" value="<?php echo $r['country'] ?>"></td>
		</tr>
		<tr>
			<td>Address Type</td>
			<td>
			<input type="checkbox" id="billing" name="address[billing]" value="1" <?php $billing = $r['billing']; if($billing == 1): ?> checked <?php endif; ?>>
			<label for="billing">Billing Address</label><br>
			<input type="checkbox" id="shipping" name="address[shipping]" value="1" <?php $shipping = $r['shipping']; if($shipping == 1): ?> checked <?php endif; ?>>
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
				<input type="submit" value="Edit" name="edit">
				<button type="button"><a href="index.php?a=gridAction">Cancel</a></button>
			</td>
		</tr>
		
	</table>	
</form>
</body>
</html>