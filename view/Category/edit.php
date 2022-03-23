<?php $category = $this->getCategory(); ?>

<?php $getCategoryWithPath = $this->getCategoryWithPath(); ?>
<?php $result = $getCategoryWithPath;  ?>


	<table border="1" width="100%">
		<form method="post" action="<?php echo $this->getUrl('save','category',null, false) ?>">
			<tr>
                <td>Id</td>
                <td><input type="text" name="category[categoryId]" value="<?php echo $category->categoryId; ?>" readonly></td>
            </tr>
			<tr>
		<td>Category</td>
		<td>
			<select name="category[parentId]">
				<option value="">Main Category</option>
				<?php foreach ($result as $key => $row) { ?>
				<option value="<?php echo $key; ?>" 
					<?php if ($category->parentId == $key) {
					 		echo "selected";
					 	} ?>><?php echo $row; ?>
				</option>
					 	<?php
					 } 
					
				?>
			</select>
		</td>
	</tr>

		<tr>
			<td>Status</td>
			<td><select name="category[status]" value="<?php echo $category->status;?>">
				<?php foreach ($category->getStatus() as $key => $value): ?>
              	<option <?php if($category->status == $key): ?> selected <?php endif; ?> value="<?php echo $key; ?>"> <?php echo $value; ?></option>
            	<?php endforeach; ?>
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
			<button type="button"><a href="<?php echo $this->getUrl('grid','category',null,true) ?>">Cancel</a></button></td>
		</tr>
	</form>        
</table>
