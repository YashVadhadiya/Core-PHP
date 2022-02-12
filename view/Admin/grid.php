<?php 
require_once ('Model/Core/Adapter.php');
$adapter = new Model_Core_Adapter();  
$admins = $adapter->fetchAll("SELECT * FROM admin");
?>

<!DOCTYPE html>
<html>
<head>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <title>Admin Grid</title>
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
    <button name="Add"><a href="index.php?c=admin&a=add">Add admin</a></button>

    <table border='1' width='100%' cellspacing="4">
        <tr>
            <th>Id</th>
            <th>First Name</th>
            <th>Last Name</th>
            <th>Email</th>
            <!-- <th>Password</th> -->
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
                    <td><?php echo $admin['id']; ?></td>
                    <td><?php echo $admin['firstName']; ?></td>
                    <td><?php echo $admin['lastName']; ?></td>
                    <td><?php echo $admin['email']; ?></td>
                    <!-- <td><?php //echo $admin['password']; echo md5($password);?></td> -->
                    <td><?php echo $admin['status']; ?></td>
                    <td><?php echo $admin['createdAt']; ?></td>
                    <td><?php echo $admin['updatedAt']; ?></td>

                    <td><a href="index.php?c=admin&a=edit&id=<?php echo $admin['id'] ?>">Edit</a></td>
                    <td><a href="index.php?c=admin&a=delete&id=<?php echo $admin['id'] ?>">Delete</a></td>
                </tr>
            <?php endforeach; ?>
        <?php endif; ?>
    </table>
</body>
</html>