<?php $config = $this->getConfig(); ?>
<?php $urlAction = new Controller_Core_Action();?>

	<body>
		<form method="POST" action="<?php echo $urlAction->getUrl('save','config',['configId' =>  $config->configId],true) ?>">
			<table border="1" width="100%" cellspacing="4">
				<!-- this is used for personal data -->
				<tr>
					<td colspan="4">
						<h1>Config details</h1></td>
				</tr>
				<tr>
					<td>Id</td>
					<td>
						<input type="text" name="config[configId]" value="<?php echo $config->configId; ?>" readonly>
					</td>
				</tr>
				<tr>
					<td>Name</td>
					<td>
						<input type="text" name="config[name]" value="<?php echo $config->name; ?>">
					</td>
				</tr>
				<tr>
					<td>Code</td>
					<td>
						<input type="text" name="config[code]" value="<?php echo $config->code; ?>">
					</td>
				</tr>
				<tr>
					<td>Value</td>
					<td>
						<input type="text" name="config[value]" value="<?php echo $config->value; ?>">
					</td>
				</tr>
				<tr>
					<td>Status</td>
					<td>
						<select name="config[status]">
							<?php foreach ($config->getStatus() as $key => $value): ?>
              			<option <?php if($config->status == $key): ?> selected <?php endif; ?> value="<?php echo $key; ?>"> <?php echo $value; ?></option>
            				<?php endforeach; ?>
						</select>
					</td>
				</tr>
				<tr>
					<td>&nbsp;</td>
					<td>
						<input type="submit" value="Edit" name="edit">
						<button type="button"><a href="<?php echo $urlAction->getUrl('grid','config',null,true) ?>">Cancel</a></button>
					</td>
				</tr>
			</table>
		</form>
