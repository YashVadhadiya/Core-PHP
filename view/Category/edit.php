<?php
$controllerCategory = new Controller_category();
?>

<!DOCTYPE html>
<html>
<head>
	<title>Category Update</title>
</head>
<body>
	<table border="1" width="100%">
		<form method="post" action="index.php?c=category&a=save">
			<tr>
                <td>Id</td>
                <td><input type="text" name="category[categoryId]" value="<?php echo $data['categories']['categoryId']; ?>" readonly></td>
            </tr>
			<tr>
				<td>Chooese Category</td>   
				<td>
					<select name="category[parentId]" value="<?php echo $data['categories']['parentId']; ?>" >
						<option>New Category</option>
						<?php $result = $controllerCategory->getCategoryWithPath(); foreach($result as $key => $value): ?>
						<option value=<?php echo $key; ?> >
						<?php echo($value); ?>
						</option>
					<?php endforeach; ?>                  
				</select>
			</td>
		</tr>

		<tr>
			<td>Status</td>
			<td><select name="category[status]" value="<?php echo $data['categories']['status'];?>">
				<option value="1" <?php if($data['categories']['status'] == 1): ?> selected = "selected" <?php endif; ?>>Active</option>
				<option value="2" <?php if($data['categories']['status'] == 2): ?> selected = "selected" <?php endif; ?>>Inactive</option>
			</select>
		</td>
	</tr>

	<tr>
		<td>Category Name</td>
		<td>
			<input type="text" name="category[categoryName]" value="<?php echo $data['categories']['categoryName']; ?>">
		</td>
	</tr>

	<tr>
		<td>&nbsp;</td>
		<td><input type="submit" name="submit" value="Submit">
			<button type="button"><a href="index.php?c=category&a=grid">Cancel</a></button></td>
		</tr>
	</form>        
</table>
</body>
</html>