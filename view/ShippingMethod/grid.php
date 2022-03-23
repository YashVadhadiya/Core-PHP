<?php $shippingMethods = $this->getShippingMethods(); ?>
<?php $perPageCount = $this->getPager()->getPerPageCount(); ?>

<script type="text/javascript">
    function url(ele)
    {
        var page = ele.value;
        var pageUrl = "<?php echo $this->getUrl('grid','shippingMethod',['p' => $this->getPager()->getStart()],false) ?>&ppr="+ele.value;
        window.open(pageUrl,"_self");
    }
</script>

<button name="Add"><a href="<?php echo $this->getUrl('add','shippingMethod',['p' => $this->getPager()->getEnd()],false) ?>">Add Shipping Method</a></button>

<button name='Start'><a href="<?php echo $this->getUrl('grid','shippingMethod',['p' => $this->getPager()->getStart()]) ?>">Start</a></button>
    <?php if($this->getPager()->getPrev() == null):?>
<button name='Prev' disabled ><a>Previous</a></button>
    <?php else: ?>
<button name='Previous'><a href="<?php echo $this->getUrl('grid','shippingMethod',['p' => $this->getPager()->getPrev()]) ?>">Previous</a></button>
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

<button name='Current'><a href="<?php echo $this->getUrl('grid','shippingMethod',['p' => $this->getPager()->getCurrent()]) ?>">Current</a></button>    
    <?php if($this->getPager()->getNext() == null):?>
<button name='next' disabled ><a>Next</a></button>
    <?php else: ?>
<button name='Next'><a href="<?php echo $this->getUrl('grid','shippingMethod',['p' => $this->getPager()->getNext()]) ?>">Next</a></button>
    <?php endif;?>
<button name='End'><a href="<?php echo $this->getUrl('grid','shippingMethod',['p' => $this->getPager()->getEnd()]) ?>">End</a></button>
		<table border="1" width="100%" cellspacing="4">
			<tr>
				<th>Id</th>
				<th>Name</th>
				<th>Note</th>
				<th>Price</th>
				<th>Status</th>
				<th>Created Date</th>
				<th>Updated Date</th>
				<th>Edit</th>
				<th>Delete</th>
			</tr>
			<?php if(!$shippingMethods): ?>
				<tr>
					<td colspan="17">No Record available.</td>
				</tr>
			<?php else : ?>
				<?php foreach ($shippingMethods as $shippingMethod): ?>
				<tr>
					<td><?php echo $shippingMethod->methodId;?></td>
					<td><?php echo $shippingMethod->name;?></td>
					<td><?php echo $shippingMethod->note;?></td>
					<td><?php echo $shippingMethod->price;?></td>
					<td><?php echo $shippingMethod->getStatus($shippingMethod->status); ?></td>
					<td><?php echo $shippingMethod->createdAt;?></td>
					<td><?php echo $shippingMethod->updatedAt;?></td>
					<td><a href="<?php echo $this->getUrl('edit','shippingMethod',['id'=> $shippingMethod->methodId],false) ?>">Edit</a></td>
					<td><a href="<?php echo $this->getUrl('delete','shippingMethod',['id'=> $shippingMethod->methodId],false) ?>">Delete</a></td>
				</tr>
				<?php endforeach;	?>
		<?php endif;  ?>
		</table>
