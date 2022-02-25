<?php $admins = $this->getAdmins(); ?>
<?php $urlAction = new Controller_Core_Action();?>

<!DOCTYPE html>
<html>

<head>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <title>Admin Grid</title>
</head>

<body>
    <!-- this is nav bar code -->
    <nav class="navbar navbar-expand-lg navbar-light bg-light"> <a class="navbar-brand" href="<?php echo $urlAction->getUrl('grid','admin',null,true) ?>">Admin</a>
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
    <button name="Add"><a href="<?php echo $urlAction->getUrl('add','admin',null,true) ?>">Add admin</a></button>
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
                            <?php echo $admin->status; ?>
                        </td>
                        <td>
                            <?php echo $admin->createdAt; ?>
                        </td>
                        <td>
                            <?php echo $admin->updatedAt; ?>
                        </td>
                        <td><a href="<?php echo $urlAction->getUrl('edit','admin',['id' =>  $admin->id],true) ?>">Edit</a></td>
                        <td><a href="<?php echo $urlAction->getUrl('delete','admin',['id' =>  $admin->id],true) ?>">Delete</a></td>
                    </tr>
                    <?php endforeach; ?>
                        <?php endif; ?>
    </table>
</body>

</html>