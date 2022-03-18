<?php $admins = $this->getAdmins(); ?>

<?php $perPageCount = $this->getPager()->getPerPageCount(); ?>

<script type="text/javascript">
    function url(ele)
    {
        var page = ele.value;
        var pageUrl = "<?php echo $this->getUrl('grid','admin',['p' => $this->getPager()->getStart()],false) ?>&ppr="+ele.value;
        window.open(pageUrl,"_self");
    }
</script>

<button name="Add"><a href="<?php echo $this->getUrl('add','admin',['p' => $this->getPager()->getStart()]) ?>">Add admin</a></button>
<button name='Start'><a href="<?php echo $this->getUrl('grid','admin',['p' => $this->getPager()->getStart()]) ?>">Start</a></button>
    <?php if($this->getPager()->getPrev() == null):?>
<button name='Prev' disabled ><a>Previous</a></button>
    <?php else: ?>
<button name='Previous'><a href="<?php echo $this->getUrl('grid','admin',['p' => $this->getPager()->getPrev()]) ?>">Previous</a></button>
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

<button name='Current'><a href="<?php echo $this->getUrl('grid','admin',['p' => $this->getPager()->getCurrent()]) ?>">Current</a></button>    
    <?php if($this->getPager()->getNext() == null):?>
<button name='next' disabled ><a>Next</a></button>
    <?php else: ?>
<button name='Next'><a href="<?php echo $this->getUrl('grid','admin',['p' => $this->getPager()->getNext()]) ?>">Next</a></button>
    <?php endif;?>
<button name='End'><a href="<?php echo $this->getUrl('grid','admin',['p' => $this->getPager()->getEnd()]) ?>">End</a></button>
    <table border='1' width='100%' cellspacing="4">
        <tr>
            <th>Id</th>
            <th>First Name</th>
            <th>Last Name</th>
            <th>Email</th>
            <th>Status</th>
            <th>Created At</th>
            <th>Updated At</th>
            <th>Edit</th>
            <th>Delete</th>
        </tr>
        <?php if(!$admins): ?>
            <tr>
                <td colspan="17">No records found.</td>
            </tr>
            <?php else: ?>
                <?php foreach($admins as $admin): ?>
                    <tr>
                        <td>
                            <?php echo $admin->id; ?>
                        </td>
                        <td>
                            <?php echo $admin->firstName; ?>
                        </td>
                        <td>
                            <?php echo $admin->lastName; ?>
                        </td>
                        <td>
                            <?php echo $admin->email; ?>
                        </td>
                        
                        <td>
                            <?php echo $admin->getStatus($admin->status); ?>
                        </td>

                        <td>
                            <?php echo $admin->createdAt; ?>
                        </td>
                        <td>
                            <?php echo $admin->updatedAt; ?>
                        </td>
                        <td><a href="<?php echo $this->getUrl('edit','admin',['id' =>  $admin->id],false) ?>">Edit</a></td>
                        <td><a href="<?php echo $this->getUrl('delete','admin',['id' =>  $admin->id],false) ?>">Delete</a></td>
                    </tr>
                    <?php endforeach; ?>
                        <?php endif; ?>
    </table>