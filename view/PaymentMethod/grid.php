<?php $paymentMethods = $this->getPaymentMethods(); ?>
<?php $perPageCount = $this->getPager()->getPerPageCount(); ?>

<script type="text/javascript">
    function url(ele)
    {
        var page = ele.value;
        var pageUrl = "<?php echo $this->getUrl('grid','paymentMethod',['p' => $this->getPager()->getStart()],false) ?>&ppr="+ele.value;
        window.open(pageUrl,"_self");
    }
</script>

<button name="Add"><a href="<?php echo $this->getUrl('add','paymentMethod',['p' => $this->getPager()->getEnd()],false) ?>">Add Payment Method</a></button>

<button name='Start'><a href="<?php echo $this->getUrl('grid','paymentMethod',['p' => $this->getPager()->getStart()]) ?>">Start</a></button>
    <?php if($this->getPager()->getPrev() == null):?>
<button name='Prev' disabled ><a>Previous</a></button>
    <?php else: ?>
<button name='Previous'><a href="<?php echo $this->getUrl('grid','paymentMethod',['p' => $this->getPager()->getPrev()]) ?>">Previous</a></button>
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

<button name='Current'><a href="<?php echo $this->getUrl('grid','paymentMethod',['p' => $this->getPager()->getCurrent()]) ?>">Current</a></button>    
    <?php if($this->getPager()->getNext() == null):?>
<button name='next' disabled ><a>Next</a></button>
    <?php else: ?>
<button name='Next'><a href="<?php echo $this->getUrl('grid','paymentMethod',['p' => $this->getPager()->getNext()]) ?>">Next</a></button>
    <?php endif;?>
<button name='End'><a href="<?php echo $this->getUrl('grid','paymentMethod',['p' => $this->getPager()->getEnd()]) ?>">End</a></button>
		<table border="1" width="100%" cellspacing="4">
			<tr>
				<th>Id</th>
				<th>Name</th>
				<th>Note</th>
				<th>Status</th>
				<th>Created Date</th>
				<th>Updated Date</th>
				<th>Edit</th>
				<th>Delete</th>
			</tr>
			<?php if(!$paymentMethods): ?>
				<tr>
					<td colspan="17">No Record available.</td>
				</tr>
			<?php else : ?>
				<?php foreach ($paymentMethods as $paymentMethod): ?>
				<tr>
					<td><?php echo $paymentMethod->methodId;?></td>
					<td><?php echo $paymentMethod->name;?></td>
					<td><?php echo $paymentMethod->note;?></td>
					<td><?php echo $paymentMethod->getStatus($paymentMethod->status); ?></td>
					<td><?php echo $paymentMethod->createdAt;?></td>
					<td><?php echo $paymentMethod->updatedAt;?></td>
					<td><a href="<?php echo $this->getUrl('edit','paymentMethod',['id'=> $paymentMethod->methodId],false) ?>">Edit</a></td>
					<td><a href="<?php echo $this->getUrl('delete','paymentMethod',['id'=> $paymentMethod->methodId],false) ?>">Delete</a></td>
				</tr>
				<?php endforeach;	?>
		<?php endif;  ?>
		</table>
