<?php
$controllerCategory = new Controller_category();
?>
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
                    <a class="nav-link" href="index.php?c=customer&a=grid" name="customer">Customer</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="index.php?c=category&a=grid" name="category">Category</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="index.php?c=product&a=grid" name="Product">Product</a>
                </li>
            </ul>
        </div>
    </nav>
    <!-- nav bar ends -->
    <button name="Add"><a href="index.php?c=category&a=add">Add Category</a></button>
    <table border=1 width="100%">

        <tr>
            <th>Id</th>
            <th>Category Name</th>
            <th>Status</th>
            <th>Created At</th>
            <th>Updated At</th>
            <th>Action</th>
        </tr>
        <?php if(!$data['categories']): ?>
        <tr>
            <td colspan="10">No records found.</td>
        </tr>
        <?php else: ?>
        <?php foreach($data['categories'] as $category): ?>
        <tr>
            <td><?php echo $category['categoryId']; ?></td>

            <td><?php $pathReturn =  $controllerCategory->getCategoryWithPath(); echo $pathReturn[$category['categoryId']]; ?>
            </td>

            <td><?php echo $category['status']; ?></td>
            <td><?php echo $category['createdAt']?></td>
            <td><?php echo $category['updatedAt']?></td>
            <td><a href="index.php?c=category&a=edit&id=<?php echo $category['categoryId']; ?>">Edit</a>
                <a href="index.php?c=category&a=delete&id=<?php echo $category['categoryId']; ?>">Delete</a>
            </td>
        </tr>
        <?php endforeach; ?>
        <?php endif; ?>
    </table>


</body>

</html>