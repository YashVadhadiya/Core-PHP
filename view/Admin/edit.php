<?php $admin = $this->getAdmin(); ?>
<?php $urlAction = new Controller_Core_Action();?>
	<html>

	<head>
		<title>Admin Edit</title>
	</head>

	<body>
		<form method="POST" action="<?php echo$urlAction->getUrl('save','admin',['id' =>  $admin->id],true) ?>">
			<table border="1" width="100%" cellspacing="4">
				<!-- this is used for personal data -->
				<tr>
					<td colspan="4">
						<h1>Admin details</h1></td>
				</tr>
				<tr>
					<td>Id</td>
					<td>
						<input type="text" name="admin[id]" value="<?php echo $admin->id; ?>" readonly>
					</td>
				</tr>
				<tr>
					<td>First Name</td>
					<td>
						<input type="text" name="admin[firstName]" value="<?php echo $admin->firstName; ?>">
					</td>
				</tr>
				<tr>
					<td>Last Name</td>
					<td>
						<input type="text" name="admin[lastName]" value="<?php echo $admin->lastName; ?>">
					</td>
				</tr>
				<tr>
					<td>Email</td>
					<td>
						<input type="text" name="admin[email]" value="<?php echo $admin->email; ?>">
					</td>
				</tr>
				<tr>
					<td>Password</td>
					<td>
						<input type="password" name="admin[password]" value="<?php echo $admin->password; ?>">
					</td>
				</tr>
				<tr>
					<td>Status</td>
					<td>
						<select name="admin[status]">
							<?php if($admin->status == 2): ?>
				              <option value='2'>Disabled</option>
				              <option value='1'>Enabled</option>
				          	<?php else: ?>
				              <option value='1'>Enabled</option>
				              <option value='2'>Disabled</option>
				          	<?php endif;?>
				          	
							<!-- <option value="1" <?php //if($admin->status==1 ): ?> selected = "selected"
								<?php //endif; ?>>Active</option>
							<option value="2" <?php //if($admin->status==2 ): ?> selected = "selected"
								<?php //endif; ?>>Inactive</option> -->
						</select>
					</td>
				</tr>
				<tr>
					<td>&nbsp;</td>
					<td>
						<input type="submit" value="Save" name="edit">
						<button type="button"><a href="<?php echo $urlAction->getUrl('grid','admin',null,true) ?>">Cancel</a></button>
					</td>
				</tr>
			</table>
		</form>
	</body>

	</html>