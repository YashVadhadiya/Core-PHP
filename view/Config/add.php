<?php $urlAction = new Controller_Core_Action();?>
<html>

<head>
	<title>Config</title>
</head>

<body>
	<form method="POST" action="<?php echo $urlAction->getUrl('save','config',null,true) ?>">
		
		<table border="1" width="100%" cellspacing="4">
			<!-- this is used for personal data -->
			<tr>
				<td colspan="4">
					<h1>Config Details</h1></td>
			</tr>
			<tr>
				<td>Name</td>
				<td>
					<input type="text" name="config[name]">
				</td>
			</tr>
			<tr>
				<td>Code</td>
				<td>
					<input type="text" name="config[code]">
				</td>
			</tr>
			<tr>
				<td>Value</td>
				<td>
					<input type="text" name="config[value]">
				</td>
			</tr>
			<tr>
				<td>Status</td>
				<td>
					<select name="config[status]">
						<option value="1">Active</option>
						<option value="2">Inactive</option>
					</select>
				</td>
			</tr>
			<tr>
				<td>&nbsp;</td>
				<td>
					<input type="submit" name="submit" value="Save">
					<button type="button"><a href="<?php echo $urlAction->getUrl('grid','config',null,true) ?>">Cancel</a></button>
				</td>
			</tr>
		</table>
	</form>
</body>

</html>