<?php $categories = $this->getCategories(); ?>
<?php $getCategoryWithPath = $this->getCategoryWithPath();?>
<?php $mediaModel = Ccc::getModel('Category_Media'); ?>
<?php $perPageCount = $this->getPager()->getPerPageCount(); ?>

<script type="text/javascript">
    function url(ele)
    {
        var page = ele.value;
        var pageUrl = "<?php echo $this->getUrl('grid','category',['p' => $this->getPager()->getStart()],false) ?>&ppr="+ele.value;
        window.open(pageUrl,"_self");
    }
</script>

<button name="Add"><a href="<?php echo $this->getUrl('add','category',['p' => $this->getPager()->getStart()]) ?>">Add category</a></button>
<button name='Start'><a href="<?php echo $this->getUrl('grid','category',['p' => $this->getPager()->getStart()]) ?>">Start</a></button>
    <?php if($this->getPager()->getPrev() == null):?>
<button name='Prev' disabled ><a>Previous</a></button>
    <?php else: ?>
<button name='Previous'><a href="<?php echo $this->getUrl('grid','category',['p' => $this->getPager()->getPrev()]) ?>">Previous</a></button>
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

<button name='Current'><a href="<?php echo $this->getUrl('grid','category',['p' => $this->getPager()->getCurrent()]) ?>">Current</a></button>    
    <?php if($this->getPager()->getNext() == null):?>
<button name='next' disabled ><a>Next</a></button>
    <?php else: ?>
<button name='Next'><a href="<?php echo $this->getUrl('grid','category',['p' => $this->getPager()->getNext()]) ?>">Next</a></button>
    <?php endif;?>
<button name='End'><a href="<?php echo $this->getUrl('grid','category',['p' => $this->getPager()->getEnd()]) ?>">End</a></button>
    <table border=1 width="100%">

        <tr>
            <th>Id</th>
            <th>Category Name</th>
            <th>Status</th>
            <th>Created At</th>
            <th>Updated At</th>
            <th>Base</th>
            <th>Thumb</th>
            <th>Small</th>
            <th>Action</th>
            <th>Media</th>
        </tr>
        <?php if(!$categories): ?>
        <tr>
            <td colspan="10">No records found.</td>
        </tr>
        <?php else: ?>
        <?php foreach($categories as $category): ?>
        <tr>
            <td><?php echo $category->categoryId; ?></td>
            <td><?php $pathReturn = $getCategoryWithPath; echo $pathReturn[$category->categoryId]; ?></td>

            <td><?php echo $category->getStatus($category->status); ?></td>
            <td><?php echo $category->createdAt?></td>
            <td><?php echo $category->updatedAt?></td>

            <td>
                <?php if(!$category->baseImage): echo "image not selected" ?>
                    <?php else: ?>
                <img src="<?php echo $mediaModel->getImageUrl() . $category->baseImage; ?>" width="75px" height="75px">
            <?php endif;?>
            </td>
            <td>
                <?php if(!$category->thumbImage): echo "image not selected" ?>
                    <?php else: ?>
                <img src="<?php echo $mediaModel->getImageUrl() . $category->thumbImage; ?>" width="75px" height="75px">
            <?php endif;?>
            </td>
            <td>
                <?php if(!$category->smallImage): echo "image not selected" ?>
                    <?php else: ?>
                <img src="<?php echo $mediaModel->getImageUrl() . $category->smallImage; ?>" width="75px" height="75px">
            <?php endif;?>
            </td>


            <td>
                <a href="<?php echo $this->getUrl('edit','category',['categoryId' =>  $category->categoryId],false) ?>">Edit</a>
                <a href="<?php echo $this->getUrl('delete','category',['categoryId' =>  $category->categoryId],false) ?>">Delete</a>
            </td>
            <td>
                <a href="<?php echo$this->getUrl('grid','category_media',['categoryId' =>  $category->categoryId],false) ?>">Media</a>
            </td>
        </tr>
        <?php endforeach; ?>
        <?php endif; ?>
    </table>