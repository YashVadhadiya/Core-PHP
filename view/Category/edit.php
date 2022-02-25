<?php $category = $this->getCategory(); ?>
<?php $urlAction = new Controller_Core_Action();?>
<?php $getCategoryWithPath = $this->getCategoryWithPath(); ?>

<!DOCTYPE html>
<html>
<head>
	<title>Category Update</title>
</head>
<body>
	<table border="1" width="100%">
		<form method="post" action="<?php echo $urlAction->getUrl('save','category',['categoryId' =>  $category->categoryId],true) ?>
">
			<tr>
                <td>Id</td>
                <td><input type="text" name="category[categoryId]" value="<?php echo $category->categoryId; ?>" readonly></td>
            </tr>
			<tr>
			<td width="10%">Category</td>
			<td>
				<select name="category[parentId]">
					<option>New Category</option>
					<?php
						$result = $getCategoryWithPath;
						foreach ($result as $key => $row) {
						 	?>
						 	<option value="<?php echo $key; ?>" <?php if ($category->parentId == $key) {
						 		echo "selected";
						 	} ?>><?php echo $row; ?></option>
						 	<?php
						 } 
						
					?>
				</select>
			</td>
		</tr>

		<tr>
			<td>Status</td>
			<td><select name="category[status]" value="<?php echo $category->status;?>">
				<option value="1" <?php if($category->status == 1): ?> selected = "selected" <?php endif; ?>>Active</option>
				<option value="2" <?php if($category->status == 2): ?> selected = "selected" <?php endif; ?>>Inactive</option>
			</select>
		</td>
	</tr>

	<tr>
		<td>Category Name</td>
		<td>
			<input type="text" name="category[categoryName]" value="<?php echo $category->categoryName; ?>">
		</td>
	</tr>

	<tr>
		<td>&nbsp;</td>
		<td><input type="submit" name="submit" value="Submit">
			<button type="button"><a href="<?php echo $urlAction->getUrl('grid','category',null,true) ?>">Cancel</a></button></td>
		</tr>
	</form>        
</table>
</body>
</html>