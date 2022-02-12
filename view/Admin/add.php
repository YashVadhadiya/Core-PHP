<html>
<head><title>Admin</title></head>
<body>
	<form  method="POST" action="index.php?c=admin&a=save">
		<tr>
			<td><input type="hidden" name="admin[id]"></td>
		</tr>
		<table border="1" width="100%" cellspacing="4">

			<!-- this is used for personal data -->
			<tr>
				<td colspan="4"><h1>Admin Details</h1></td>
			</tr>
			
			<tr>
				<td>First Name</td>
				<td><input type="text" name="admin[firstName]"></td>
			</tr>
			
			<tr>
				<td >Last Name</td>
				<td><input type="text" name="admin[lastName]"></td>
			</tr>

			<tr>
				<td >Email</td>
				<td><input type="text" name="admin[email]" required></td>
			</tr>

			<tr>
				<td >Password</td>
				<td><input type="password" name="admin[password]" required></td>
			</tr>
			<tr>
				<td >Status</td>
				<td>
					<select name="admin[status]">
						<option value="1">Active</option>
						<option value="2">Inactive</option>
					</select>
				</td>
			</tr>
			
			<tr>
				<td >&nbsp;</td>
				<td>
					<input type="submit" name="submit" value="Save">
					<button type="button"><a href="index.php?c=admin&a=grid">Cancel</a></button>
				</td>
			</tr>
			
		</table>
	</form>
</body>
</html>