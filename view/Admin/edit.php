<?php $admin = $this->getAdmin(); ?>
<?php $urlAction = new Controller_Core_Action();?>
		<form method="POST" action="<?php echo$urlAction->getUrl('save','admin',null, false) ?>">
			<table border="1" width="100%" cellspacing="4">
				<!-- this is used for personal data -->
				<tr>
					<td colspan="4">
						<h1>Admin details</h1>
					</td>
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
						<input type="email" name="admin[email]" value="<?php echo $admin->email; ?>">
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
							<?php foreach ($admin->getStatus() as $key => $value): ?>
              			<option <?php if($admin->status == $key): ?> selected <?php endif; ?> value="<?php echo $key; ?>"> <?php echo $value; ?></option>
            				<?php endforeach; ?>
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