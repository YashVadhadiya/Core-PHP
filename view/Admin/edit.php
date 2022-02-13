<?php
$controllerAdmin = new Controller_Admin();
?>
	<html>

	<head>
		<title>Admin Edit</title>
	</head>

	<body>
		<form method="POST" action="index.php?c=admin&a=save&id=<?php echo $_GET['id']?>">
			<table border="1" width="100%" cellspacing="4">
				<!-- this is used for personal data -->
				<tr>
					<td colspan="4">
						<h1>Admin details</h1></td>
				</tr>
				<tr>
					<td>Id</td>
					<td>
						<input type="text" name="admin[id]" value="<?php echo $data['admins']['id']; ?>" readonly>
					</td>
				</tr>
				<tr>
					<td>First Name</td>
					<td>
						<input type="text" name="admin[firstName]" value="<?php echo $data['admins']['firstName']; ?>">
					</td>
				</tr>
				<tr>
					<td>Last Name</td>
					<td>
						<input type="text" name="admin[lastName]" value="<?php echo $data['admins']['lastName']; ?>">
					</td>
				</tr>
				<tr>
					<td>Email</td>
					<td>
						<input type="text" name="admin[email]" value="<?php echo $data['admins']['email']; ?>">
					</td>
				</tr>
				<tr>
					<td>password</td>
					<td>
						<input type="password" name="admin[password]" value="<?php echo $data['admins']['password']; ?>">
					</td>
				</tr>
				<tr>
					<td>Status</td>
					<td>
						<select name="admin[status]">
							<option value="1" <?php if($data[ 'admins'][ 'status']==1 ): ?> selected = "selected"
								<?php endif; ?>>Active</option>
							<option value="2" <?php if($data[ 'admins'][ 'status']==2 ): ?> selected = "selected"
								<?php endif; ?>>Inactive</option>
						</select>
					</td>
				</tr>
				<tr>
					<td>&nbsp;</td>
					<td>
						<input type="submit" value="Edit" name="edit">
						<button type="button"><a href="index.php?c=admin&a=grid">Cancel</a></button>
					</td>
				</tr>
			</table>
		</form>
	</body>

	</html>