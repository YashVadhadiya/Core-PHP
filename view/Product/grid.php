<?php $products = $this->getProducts(); ?>
<?php $urlAction = new Controller_Core_Action();?>

	<button name="Add"><a href="<?php echo $urlAction->getUrl('add','product',null,true) ?>">Add Product</a></button>

	<table border=1 width="100%">

		<tr>
			<th>Id</th>
			<th>Name</th>
			<th>Price</th>
			<th>Quantity</th>
			<th>SKU</th>
			<th>Status</th>
			<th>Created At</th>
			<th>Updated At</th>
			<th>Base</th>
			<th>Thumb</th>
			<th>Small</th>
			<th>Action</th>
			<th>Media</th>
		</tr>
		<?php if(!$products): ?>
			<tr>
				<td colspan="10">No records found.</td>
			</tr>
		<?php else: ?>
			<?php foreach($products as $product): ?>
				<tr>
					<td><?php echo $product->id; ?></td>
					<td><?php echo $product->name; ?></td>
					<td><?php echo $product->price; ?></td>
					<td><?php echo $product->quantity; ?></td>
					<td><?php echo $product->sku; ?></td>
					<td><?php echo $product->getStatus($product->status); ?></td>
					<td><?php echo $product->createdAt;?></td>
					<td><?php echo $product->updatedAt;?></td>
					
					<td>
                		<?php if(!$product->baseImage): echo "image not selected" ?>
                    		<?php else: ?>
                		<img src="<?php echo 'Media/Product/' . $product->baseImage; ?>" width="75px" height="75px">
            			<?php endif;?>
            		</td>
            		<td>
                		<?php if(!$product->thumbImage): echo "image not selected" ?>
                    		<?php else: ?>
                		<img src="<?php echo 'Media/Product/' . $product->thumbImage; ?>" width="75px" height="75px">
            			<?php endif;?>
            		</td>
            		<td>
                		<?php if(!$product->smallImage): echo "image not selected" ?>
                    		<?php else: ?>
                		<img src="<?php echo 'Media/Product/' . $product->smallImage; ?>" width="75px" height="75px">
            			<?php endif;?>
            		</td>

					
					<td><a href="<?php echo $urlAction->getUrl('edit','product',['id' =>  $product->id],true) ?>">Edit</a> 
						<a href="<?php echo $urlAction->getUrl('delete','product',['id' =>  $product->id],true) ?>">Delete</a></td>
					<td><a href="<?php echo $urlAction->getUrl('grid','product_media',['id' =>  $product->id],true) ?>">Media</a></td>
				</tr>
				<?php endforeach; ?>
			<?php endif; ?>
		</table>