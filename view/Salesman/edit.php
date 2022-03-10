<?php $salesman = $this->getSalesman(); ?>
<?php $urlAction = new Controller_Core_Action();?>

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
							<?php foreach ($salesman->getStatus() as $key => $value): ?>
              			<option <?php if($salesman->status == $key): ?> selected <?php endif; ?> value="<?php echo $key; ?>"> <?php echo $value; ?></option>
            				<?php endforeach; ?>
						</select>
					</td>
				</tr>
				<tr>
					<td>Percentage</td>
					<td>
						<input type="number" name="salesman[percentage]" value="<?php echo $salesman->percentage; ?>">
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