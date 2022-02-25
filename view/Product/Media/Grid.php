<?php $productMedias = $this->getProductMedias(); $id = $_GET['id'];?>	
<?php $urlAction = new Controller_Core_Action(); ?>
<html>
<head>
	<meta name='viewport' content='width=device-width, initial-scale=1.0, maximum-scale=1.0' />
	
</head>
<body>
	<h3> Product Media Details </h3> 
	<form action="<?php echo $urlAction->getUrl('save','product_media',['id' =>  $id],true) ?>" method="POST">
		<button type="submit" name="Add"> Update </button>
	</form>
	<form action="<?php echo $urlAction->getUrl('grid','product',null,true) ?>" method="POST">
		<button type="submit" name="Cancle"> Cancle </button>
	</form>

	<table border=1 width=100%>
		<tr align="center">
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
				<tr align="center">
		    		<td><?php echo $media->imageId; ?></td>
					<td><?php echo $media->image; ?></td>
					<td><input type="radio" name="base"></td>
					<td><input type="radio" name="thumb"></td>
					<td><input type="radio" name="small"></td>
					<td><input type="checkbox" name="gallary"></td>
					<td><input type="checkbox" name="status"></td>
					<td><input type="checkbox" name="remove"></td>
		    		
		    		
		    	</tr>
		  	<?php endforeach; ?>
		<?php else: ?>
			<tr><td colspan='8'>No Record Available</td></tr>
		<?php endif; ?>
 
	</table>
	<br>
	<br>
	<br>
	<br>
				<form align="center" action="<?php echo $urlAction->getUrl('save','product_media',['id' =>  $id],true) ?>" method="POST" enctype="multipart/form-data">
				<input type="file" name="image[]">
				<input type="submit" name="submit" value="Submit">



</form>



</body>
</html>