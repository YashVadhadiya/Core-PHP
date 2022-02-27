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
    <!-- this is nav bar code -->
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <a class="navbar-brand" href="index.php?c=admin&a=grid">Admin</a>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav">
                <li class="nav-item active">
                    <a class="nav-link" href="<?php echo $urlAction->getUrl('grid','customer',null,true) ?>" name="customer">Customer</a>
                </li>
                <li class="nav-item active">
                    <a class="nav-link" href="<?php echo $urlAction->getUrl('grid','category',null,true) ?>" name="category">Category</a>
                </li>
                <li class="nav-item active">
                    <a class="nav-link" href="<?php echo $urlAction->getUrl('grid','product',null,true) ?>" name="Product">Product</a>
                </li>
                <li class="nav-item active">
                    <a class="nav-link" href="<?php echo $urlAction->getUrl('grid','config',null,true) ?>" name="config">Config</a>
                </li>
            </ul>
        </div>
    </nav>
    <!-- nav bar ends -->
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

            <td><?php echo $category->baseImage ?></td>
            <td><?php echo $category->thumbImage ?></td>
            <td><?php echo $category->smallImage ?></td>


            <td><a href="<?php echo $urlAction->getUrl('edit','category',['categoryId' =>  $category->categoryId],true) ?>">Edit</a>
                <a href="<?php echo $urlAction->getUrl('delete','category',['categoryId' =>  $category->categoryId],true) ?>">Delete</a>
            </td>
            <td><a href="<?php echo$urlAction->getUrl('grid','category_media',['categoryId' =>  $category->categoryId],true) ?>">Media</a></td>
        </tr>
        <?php endforeach; ?>
        <?php endif; ?>
    </table>


</body>

</html>