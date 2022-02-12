<?php 
require_once ('Model/Core/Adapter.php');
$adapter = new Model_Core_Adapter();
$id = $_GET['id'];
$customers = $adapter->fetchRow("SELECT c.*, a.* from customer c left join address a on c.id = a.customerId WHERE c.id = $id");

$firstName = $customers['firstName'];
$lastName = $customers['lastName'];
$email = $customers['email'];
$phone = $customers['phone'];
$status = $customers['status'];
$address = $customers['address'];
$postalCode = $customers['postalCode'];
$city = $customers['city'];
$state = $customers['state'];
$country = $customers['country'];
$billing = $customers['billing'];
$shipping = $customers['shipping'];

?>

<html>
<head><title>Category Update</title></head>
<body>
	<form method="POST" action="index.php?c=customer&a=save&id=<?php echo $_GET['id']?>">
		<table border="1" width="100%" cellspacing="4">

			<!-- this is used for personal data -->
			<tr>
				<td colspan="4"><h1>Personal details</h1></td>
			</tr>

			<tr>
				<td >Id</td>
				<td><input type="text" name="customer[id]" value="<?php echo $id; ?>"></td>
			</tr>	
			<tr>
				<td >First Name</td>
				<td><input type="text" name="customer[firstName]" value="<?php echo $firstName ?>"></td>
			</tr>
			
			<tr>
				<td >Last Name</td>
				<td><input type="text" name="customer[lastName]"  value="<?php echo $lastName ?>"></td>
			</tr>

			<tr>
				<td >Email</td>
				<td><input type="text" name="customer[email]"  value="<?php echo $email ?>"></td>
			</tr>

			<tr>
				<td >Phone</td>
				<td><input type="text" name="customer[phone]" value="<?php echo $phone ?>"></td>
			</tr>
			<tr>
				<td colspan="4"><h1>Customer Address</h1></td>
			</tr>
			<tr>
				<td>Address</td>
				<td><input type="text" name="address[address]"  value="<?php echo $address ?>"></td>
			</tr>
			<tr>
				<td >Postal Code</td>
				<td><input type="text" name="address[postalCode]"  value="<?php echo $postalCode ?>"></td>
			</tr>
			<tr>
				<td >City</td>
				<td><input type="text" name="address[city]"  value="<?php echo $city ?>"></td>
			</tr>
			<tr>
				<td >State</td>
				<td><input type="text" name="address[state]"  value="<?php echo $state ?>"></td>
			</tr>
			<tr>
				<td>Country</td>
				<td><input type="text" name="address[country]" value="<?php echo $country ?>"></td>
			</tr>
			<tr>
				<td>Address Type</td>
				<td>
					<input type="checkbox" id="billing" name="address[billing]" value="1" <?php $billing = $billing; if($billing == 1): ?> checked <?php endif; ?>>
					<label for="billing">Billing Address</label><br>
					<input type="checkbox" id="shipping" name="address[shipping]" value="1" <?php $shipping = $shipping; if($shipping == 1): ?> checked <?php endif; ?>>
					<label for="shipping">Shipping Address</label><br>
				</td>
			</tr>

			<tr>
				<td >Status</td>
				<td>
					<select name="customer[status]">
						<option value="1" <?php $status = $status; if($status == 1): ?> checked <?php endif; ?>>Active</option>
						<option value="2" <?php $status = $status; if($status == 2): ?> checked <?php endif; ?>>Inactive</option>
					</select>
				</td>
			</tr>
			
			<tr>
				<td >&nbsp;</td>
				<td>
					<input type="submit" value="Edit" name="edit">
					<button type="button"><a href="index.php?c=customer&a=grid">Cancel</a></button>
				</td>
			</tr>
			
		</table>	
	</form>
</body>
</html>