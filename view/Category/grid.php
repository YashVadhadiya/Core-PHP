<?php $categories = $this->getCategories(); ?>
<?php $getCategoryWithPath = $this->getCategoryWithPath(); ?>
<?php $urlAction = new Controller_Core_Action();?>
<!DOCTYPE html>
<html>

<head>
    <title>Category Grid</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css"
        integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">

</head>

<body>

    <button name="Add"><a href="<?php echo $urlAction->getUrl('add','category',null,true) ?>">Add Category</a></button>
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

            <td><?php $pathReturn =  $getCategoryWithPath; echo $pathReturn[$category->categoryId]; ?></td>

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
                <a href="<?php echo $urlAction->getUrl('edit','category',['categoryId' =>  $category->categoryId],true) ?>">Edit</a>
                <a href="<?php echo $urlAction->getUrl('delete','category',['categoryId' =>  $category->categoryId],true) ?>">Delete</a>
            </td>
            <td>
                <a href="<?php echo$urlAction->getUrl('grid','category_media',['categoryId' =>  $category->categoryId],true) ?>">Media</a>
            </td>
        </tr>
        <?php endforeach; ?>
        <?php endif; ?>
    </table>


</body>

</html>