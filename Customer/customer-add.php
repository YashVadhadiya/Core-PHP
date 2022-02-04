<html>
<head><title>Category Add</title></head>
<body>
<form  method="POST" action="index.php?a=saveAction">
	<table border="1" width="100%" cellspacing="4">

	<!-- this is used for personal data -->
		<tr>
			<td>Personal details</td>
		</tr>

		<tr>
			<td >First Name</td>
			<td><input type="text" name="firstName"></td>
		</tr>
		
		<tr>
			<td >Last Name</td>
			<td><input type="text" name="lastName"></td>
		</tr>

		<tr>
			<td >Email</td>
			<td><input type="text" name="email"></td>
		</tr>

		<tr>
			<td >Phone</td>
			<td><input type="text" name="phone"></td>
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
				<input type="submit" name="submit" value="Save">
				<button type="button"><a href="index.php?a=gridAction">Cancel</a></button>
			</td>
		</tr>
		
	</table>	
</form>
</body>
</html>