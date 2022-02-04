<?php 
require_once ('Adapter.php');
$adapter = new Adapter();
$id = $_GET['id'];
$customers = $adapter->fetchAll("SELECT * FROM `customer` WHERE `id` = $id");
$r = mysqli_fetch_assoc($customers);
?>

<html>
<head><title>Category Update</title></head>
<body>
<form method="POST" action="index.php?a=saveAction">
	<table border="1" width="100%" cellspacing="4">

	<!-- this is used for personal data -->
		<tr>
			<td>Personal details</td>
		</tr>

		<tr>
			<td >Id</td>
			<td><input type="hidden" name="id" value="<?php echo $r['id']; ?>"></td>

		<tr>
			<td >First Name</td>
			<td><input type="text" name="firstName" value="<?php echo $r['firstName'] ?>"></td>
		</tr>
		
		<tr>
			<td >Last Name</td>
			<td><input type="text" name="lastName"  value="<?php echo $r['lastName'] ?>"></td>
		</tr>

		<tr>
			<td >Email</td>
			<td><input type="text" name="email"  value="<?php echo $r['email'] ?>"></td>
		</tr>

		<tr>
			<td >Phone</td>
			<td><input type="text" name="phone"  value="<?php echo $r['phone'] ?>"></td>
		</tr>

		<tr>
			<td >Status</td>
			<td>
				<select name="status">
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