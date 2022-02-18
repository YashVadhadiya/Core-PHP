<?php $category = $this->getCategory(); ?>

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
                <td><input type="text" name="category[categoryId]" value="<?php echo $category['categoryId']; ?>" readonly></td>
            </tr>
			<tr>
				<td>Chooese Category</td>   
				<td>
					<select name="category[parentId]" value="<?php echo $category['parentId']; ?>" >
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
			<td><select name="category[status]" value="<?php echo $category['status'];?>">
				<option value="1" <?php if($category['status'] == 1): ?> selected = "selected" <?php endif; ?>>Active</option>
				<option value="2" <?php if($category['status'] == 2): ?> selected = "selected" <?php endif; ?>>Inactive</option>
			</select>
		</td>
	</tr>

	<tr>
		<td>Category Name</td>
		<td>
			<input type="text" name="category[categoryName]" value="<?php echo $category['categoryName']; ?>">
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