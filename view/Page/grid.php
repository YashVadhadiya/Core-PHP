<?php $pages = $this->getPages(); ?>
<?php $urlAction = new Controller_Core_Action(); ?>
<?php $perPageCount = $this->getPager()->getPerPageCount(); ?>

<script type="text/javascript">
    function url(ele)
    {
        var page = ele.value;
        var pageUrl = "http://localhost/cybercom/Core-PHP/index.php?c=page&a=grid&p=1&ppr="+ele.value;
        window.open(pageUrl,"_self");
    }
</script>

<button name="Add"><a href="<?php echo $urlAction->getUrl('add','page',['p' => $this->getPager()->getEnd()],false) ?>">Add page</a></button>

<button name='Start'><a href="<?php echo $urlAction->getUrl('grid','page',['p' => $this->getPager()->getStart()]) ?>">Start</a></button>
    <?php if($this->getPager()->getPrev() == null):?>
<button name='Prev' disabled ><a>Previous</a></button>
    <?php else: ?>
<button name='Previous'><a href="<?php echo $urlAction->getUrl('grid','page',['p' => $this->getPager()->getPrev()]) ?>">Previous</a></button>
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

<button name='Current'><a href="<?php echo $urlAction->getUrl('grid','page',['p' => $this->getPager()->getCurrent()]) ?>">Current</a></button>    
    <?php if($this->getPager()->getNext() == null):?>
<button name='next' disabled ><a>Next</a></button>
    <?php else: ?>
<button name='Next'><a href="<?php echo $urlAction->getUrl('grid','page',['p' => $this->getPager()->getNext()]) ?>">Next</a></button>
    <?php endif;?>
<button name='End'><a href="<?php echo $urlAction->getUrl('grid','page',['p' => $this->getPager()->getEnd()]) ?>">End</a></button>
    
    <table border='1' width='100%' cellspacing="4">
        <tr>
            <th>Id</th>
            <th>Name</th>
            <th>Code</th>
            <th>Content</th>
            <th>Status</th>
            <th>Created At</th>
            <th>Updated At</th>
            <th>Edit</th>
            <th>Delete</th>
        </tr>
        <?php if(!$pages): ?>
            <tr>
                <td colspan="17">No records found.</td>
            </tr>
            <?php else: ?>
                <?php foreach($pages as $page): ?>
                    <tr>
                        <td>
                            <?php echo $page->pageId; ?>
                        </td>
                        <td>
                            <?php echo $page->name; ?>
                        </td>
                        <td>
                            <?php echo $page->code; ?>
                        </td>
                        <td>
                            <?php echo $page->content; ?>
                        </td>
                        
                        <td>
                            <?php echo $page->getStatus($page->status); ?>
                        </td>

                        <td>
                            <?php echo $page->createdAt; ?>
                        </td>
                        <td>
                            <?php echo $page->updatedAt; ?>
                        </td>
                        <td><a href="<?php echo $urlAction->getUrl('edit','page',['id' =>  $page->pageId],false) ?>">Edit</a></td>
                        <td><a href="<?php echo $urlAction->getUrl('delete','page',['id' =>  $page->pageId], false) ?>">Delete</a></td>
                    </tr>
                    <?php endforeach; ?>
                        <?php endif; ?>
    </table>