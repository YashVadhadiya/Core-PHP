<?php $salesman = $this->getSalesman(); ?>
<?php $urlAction = new Controller_Core_Action();?>
	<html>

	<head>
		<title>Salesman Edit</title>
	</head>

	<body>
		<form method="POST" action="<?php echo $urlAction->getUrl('save','salesman',['id' =>  $salesman->salesmanId],true) ?>">
			<table border="1" width="100%" cellspacing="4">
				<!-- this is used for personal data -->
				<tr>
					<td colspan="4">
						<h1>salesman details</h1></td>
				</tr>
				<tr>
					<td>Id</td>
					<td>
						<input type="text" name="salesman[salesmanId]" value="<?php echo $salesman->salesmanId; ?>" readonly>
					</td>
				</tr>
				<tr>
					<td>First Name</td>
					<td>
						<input type="text" name="salesman[firstName]" value="<?php echo $salesman->firstName; ?>">
					</td>
				</tr>
				<tr>
					<td>Last Name</td>
					<td>
						<input type="text" name="salesman[lastName]" value="<?php echo $salesman->lastName; ?>">
					</td>
				</tr>
				<tr>
					<td>Email</td>
					<td>
						<input type="text" name="salesman[email]" value="<?php echo $salesman->email; ?>">
					</td>
				</tr>
				<tr>
					<td>Phone</td>
					<td>
						<input type="text" name="salesman[phone]" value="<?php echo $salesman->phone; ?>">
					</td>
				</tr>
				<tr>
					<td>Status</td>
					<td>
						<select name="salesman[status]">
							<?php if($salesman->status == 2): ?>
				              <option value='2'>Disabled</option>
				              <option value='1'>Enabled</option>
				          	<?php else: ?>
				              <option value='1'>Enabled</option>
				              <option value='2'>Disabled</option>
				          	<?php endif;?>
				          	
							<!-- <option value="1" <?php //if($salesman->status==1 ): ?> selected = "selected"
								<?php //endif; ?>>Active</option>
							<option value="2" <?php //if($salesman->status==2 ): ?> selected = "selected"
								<?php //endif; ?>>Inactive</option> -->
						</select>
					</td>
				</tr>
				<tr>
					<td>&nbsp;</td>
					<td>
						<input type="submit" value="Save" name="edit">
						<button type="button"><a href="<?php echo $urlAction->getUrl('grid','salesman',null,true) ?>">Cancel</a></button>
					</td>
				</tr>
			</table>
		</form>
	</body>

	</html>