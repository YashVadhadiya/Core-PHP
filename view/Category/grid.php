<?php $categories = $this->getCategories(); //print_r($categories);  ?>
<?php $getCategoryWithPath = $this->getCategoryWithPath();?>
<?php $urlAction = new Controller_Core_Action();?>

    <button name="Add"><a href="<?php echo $urlAction->getUrl('add','category',null,false) ?>">Add Category</a></button>
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
            <!-- <td><?php //echo $getCategoryWithPath[$category->categoryId] ?></td> -->
            <td><?php $pathReturn = $getCategoryWithPath; echo $pathReturn[$category->categoryId]; ?></td>

            <td><?php echo $category->getStatus($category->status); ?></td>
            <td><?php echo $category->createdAt?></td>
            <td><?php echo $category->updatedAt?></td>

            <td>
                <?php if(!$category->baseImage): echo "image not selected" ?>
                    <?php else: ?>
                <img src="<?php echo 'Media/Category/' . $category->baseImage; ?>" width="75px" height="75px">
            <?php endif;?>
            </td>
            <td>
                <?php if(!$category->thumbImage): echo "image not selected" ?>
                    <?php else: ?>
                <img src="<?php echo 'Media/Category/' . $category->thumbImage; ?>" width="75px" height="75px">
            <?php endif;?>
            </td>
            <td>
                <?php if(!$category->smallImage): echo "image not selected" ?>
                    <?php else: ?>
                <img src="<?php echo 'Media/Category/' . $category->smallImage; ?>" width="75px" height="75px">
            <?php endif;?>
            </td>


            <td>
                <a href="<?php echo $urlAction->getUrl('edit','category',['categoryId' =>  $category->categoryId],false) ?>">Edit</a>
                <a href="<?php echo $urlAction->getUrl('delete','category',['categoryId' =>  $category->categoryId],false) ?>">Delete</a>
            </td>
            <td>
                <a href="<?php echo$urlAction->getUrl('grid','category_media',['categoryId' =>  $category->categoryId],false) ?>">Media</a>
            </td>
        </tr>
        <?php endforeach; ?>
        <?php endif; ?>
    </table>