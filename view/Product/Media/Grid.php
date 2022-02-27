<?php $productMedias = $this->getProductMedias(); 
$id= $_GET['id'];?>	
<?php $urlAction = new Controller_Core_Action(); ?>
<html>
<head>
	<meta name='viewport' content='width=device-width, initial-scale=1.0, maximum-scale=1.0' />
	
</head>
<body>
	

	<form action="<?php echo $urlAction->getUrl('save','product_media',['id' =>  $id],true) ?>" method="POST" align="center">
		<input type="submit" name="update" value="UPDATE"> 
	<button ><a href="<?php echo $urlAction->getUrl('grid','product',null,true) ?>">Back to Product Grid</a></button>

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
			<?php if($productMedias): ?>
			
				<?php foreach ($productMedias as $media): ?>		
					<tr>
			    		<td><?php echo $media->imageId ; ?></td>
						<td><?php echo $media->image ; ?></td>
						
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
	</form>
	<br>
	<br>
	<br>
	<br>
				<form align="center" action="<?php echo $urlAction->getUrl('add','product_media',['id' =>  $id],true) ?>" method="POST" enctype="multipart/form-data">
				<input type="file" name="image[]">
				<input type="submit" name="submit" value="Submit">



</form>



</body>
</html>