<?php $vendors = $this->getVendors(); ?>
<?php $urlAction = new Controller_Core_Action();?>
<?php $perPageCount = $this->getPager()->getPerPageCount(); ?>

<script type="text/javascript">
    function url(ele)
    {
        var page = ele.value;
        var pageUrl = "<?php echo $urlAction->getUrl('grid','vendor',['p' => $this->getPager()->getStart()],false) ?>&ppr="+ele.value;
        window.open(pageUrl,"_self");
    }
</script>

<button name="Add"><a href="<?php echo $urlAction->getUrl('add','vendor',['p' => $this->getPager()->getStart()]) ?>">Add vendor</a></button>
<button name='Start'><a href="<?php echo $urlAction->getUrl('grid','vendor',['p' => $this->getPager()->getStart()]) ?>">Start</a></button>
    <?php if($this->getPager()->getPrev() == null):?>
<button name='Prev' disabled ><a>Previous</a></button>
    <?php else: ?>
<button name='Previous'><a href="<?php echo $urlAction->getUrl('grid','vendor',['p' => $this->getPager()->getPrev()]) ?>">Previous</a></button>
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

<button name='Current'><a href="<?php echo $urlAction->getUrl('grid','vendor',['p' => $this->getPager()->getCurrent()]) ?>">Current</a></button>    
    <?php if($this->getPager()->getNext() == null):?>
<button name='next' disabled ><a>Next</a></button>
    <?php else: ?>
<button name='Next'><a href="<?php echo $urlAction->getUrl('grid','vendor',['p' => $this->getPager()->getNext()]) ?>">Next</a></button>
    <?php endif;?>
<button name='End'><a href="<?php echo $urlAction->getUrl('grid','vendor',['p' => $this->getPager()->getEnd()]) ?>">End</a></button>

    <table border='1' width='100%' cellspacing="4">
        <tr>
            <th>Id</th>
            <th>First Name</th>
            <th>Last Name</th>
            <th>Email</th>
            <th>Mobile</th>
            <th>Status</th>
            <th>Created At</th>
            <th>Updated At</th>
            <th>Address Id</th>
            <th>Address</th>
            <th>Postal Code</th>
            <th>City</th>
            <th>State</th>
            <th>Country</th>  
            <th>Edit</th>
            <th>Delete</th>
        </tr>
        
        <?php if(!$vendors): ?>
            <tr>
                <td colspan="17">No records found.</td>
            </tr>
        <?php else: ?>
            <?php foreach($vendors as $vendor): ?>
                <tr>
                    <td><?php echo $vendor->vendorId; ?></td>
                    <td><?php echo $vendor->firstName; ?></td>
                    <td><?php echo $vendor->lastName; ?></td>
                    <td><?php echo $vendor->email; ?></td>
                    <td><?php echo $vendor->phone; ?></td>
                    <td><?php echo $vendor->getStatus($vendor->status); ?></td>
                    <td><?php echo $vendor->createdAt; ?></td>
                    <td><?php echo $vendor->updatedAt; ?></td>
                    <td><?php echo $vendor->vendorAddressId; ?></td>
                    <td><?php echo $vendor->address; ?></td>    
                    <td><?php echo $vendor->postalCode; ?></td>
                    <td><?php echo $vendor->city; ?></td>
                    <td><?php echo $vendor->state; ?></td>
                    <td><?php echo $vendor->country; ?></td>

                    <td><a href="<?php echo $urlAction->getUrl('edit','vendor',['id' =>  $vendor->vendorId],false) ?>">Edit</a></td>
                    <td><a href="<?php echo $urlAction->getUrl('delete','vendor',['id' =>  $vendor->vendorId],false) ?>">Delete</a></td>
                </tr>
            <?php endforeach; ?>
        <?php endif; ?>
    </table>