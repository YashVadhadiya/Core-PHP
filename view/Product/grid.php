<?php $products = $this->getProducts(); ?>

<?php $perPageCount = $this->getPager()->getPerPageCount(); ?>

<script type="text/javascript">
    function url(ele)
    {
        var page = ele.value;
        var pageUrl = "<?php echo $this->getUrl('grid','product',['p' => $this->getPager()->getStart()],false) ?>&ppr="+ele.value;
        window.open(pageUrl,"_self");
    }
</script>

<button name="Add"><a href="<?php echo $this->getUrl('add','product',['p' => $this->getPager()->getStart()]) ?>">Add product</a></button>
<button name='Start'><a href="<?php echo $this->getUrl('grid','product',['p' => $this->getPager()->getStart()]) ?>">Start</a></button>
    <?php if($this->getPager()->getPrev() == null):?>
<button name='Prev' disabled ><a>Previous</a></button>
    <?php else: ?>
<button name='Previous'><a href="<?php echo $this->getUrl('grid','product',['p' => $this->getPager()->getPrev()]) ?>">Previous</a></button>
    <?php endif;?>

<select name="page" id="page" onchange="url(this)">
    <?php foreach ($this->getPager()->getPerPageCountOptions() as $perPage): ?>
        <?php if($perPageCount == $perPage): ?>
        <option selected='selected' value="<?php echo $perPage; ?>"> 
            <?php echo $perPage; ?> 
            </option>
        <?php else:?>
            <option value="<?php echo $perPage; ?>"> 
            <?php echo $perPage; ?> 
            </option>
        <?php endif; ?>
    <?php endforeach; ?>
</select>

<button name='Current'><a href="<?php echo $this->getUrl('grid','product',['p' => $this->getPager()->getCurrent()]) ?>">Current</a></button>    
    <?php if($this->getPager()->getNext() == null):?>
<button name='next' disabled ><a>Next</a></button>
    <?php else: ?>
<button name='Next'><a href="<?php echo $this->getUrl('grid','product',['p' => $this->getPager()->getNext()]) ?>">Next</a></button>
    <?php endif;?>
<button name='End'><a href="<?php echo $this->getUrl('grid','product',['p' => $this->getPager()->getEnd()]) ?>">End</a></button>
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

					
					<td><a href="<?php echo $this->getUrl('edit','product',['id' =>  $product->id],false) ?>">Edit</a> 
						<a href="<?php echo $this->getUrl('delete','product',['id' =>  $product->id],false) ?>">Delete</a></td>
					<td><a href="<?php echo $this->getUrl('grid','product_media',['id' =>  $product->id],false) ?>">Media</a></td>
				</tr>
				<?php endforeach; ?>
			<?php endif; ?>
		</table>