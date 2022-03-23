<?php $categoryMedias = $this->getCategoryMedias(); ?>	
<?php $mediaModel = Ccc::getModel('Category_Media')?>

<form action="<?php echo $this->getUrl('save','category_media',null,false) ?>" method="POST" align="center">
	<input type="submit" name="update" value="UPDATE"> 
	<button ><a href="<?php echo $this->getUrl('grid','category',null,true) ?>">Back to Category Grid</a></button>
<br></br>
	<table border=1 width=100%>
		<tr>
			<th>Image Id</th>
			<th>Image</th>
			<th>Base</th>
			<th>Thumb</th>
			<th>Small</th>
			<th>Gallary</th>
			<th>Status</th>
			<th>Remove</th>

		</tr>
		<?php if($categoryMedias): ?>

			<?php foreach ($categoryMedias as $media): ?>		
				<tr>
					<td><?php echo $media->imageId ; ?></td>
					<td><img src="<?php echo $mediaModel->getImageUrl() . $media->image; ?>" width = 75px height = 75px></td>
					
					<td><input type="radio" name="media[base]" value="<?php echo $media->imageId?>"<?php echo ($media->base==1) ? 'checked' : '' ; ?>></td>
					<td><input type="radio" name="media[thumb]" value="<?php echo $media->imageId?>"<?php echo ($media->thumb==1) ? 'checked' : '' ;?>></td>
					<td><input type="radio" name="media[small]" value="<?php echo $media->imageId?>"<?php echo ($media->small==1) ? 'checked' : '' ;?>></td>
					<td><input type="checkbox" name="media[gallery][]" value="<?php echo $media->imageId ?>"<?php echo ($media->gallery==1) ? 'checked' : '' ; ?>></td>
					<td><input type="checkbox" name="media[status][]" value="<?php echo $media->imageId ?>"<?php echo ($media->status==1) ? 'checked' : '' ; ?>></td>
					<td><input type="checkbox" name="media[remove][]" value="<?php echo $media->imageId ?>"></td>	

				</tr>
			<?php endforeach; ?>
		<?php else: ?>
			<tr><td colspan='8'>No Record Available</td></tr>
		<?php endif; ?>
	</table>
	<br></br>
</form>
<form align="center" action="<?php echo $this->getUrl('add','category_media',null,false) ?>" method="POST" enctype="multipart/form-data">
	<input type="file" name="image[]" accept="image/*">
	<input type="submit" name="submit" value="Upload">
</form>