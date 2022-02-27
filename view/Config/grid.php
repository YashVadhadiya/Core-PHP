<?php $configs = $this->getConfigs(); ?>
<?php $urlAction = new Controller_Core_Action();?>

<!DOCTYPE html>
<html>

<head>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <title>Config Grid</title>
</head>

<body>
    <!-- this is nav bar code -->
    <nav class="navbar navbar-expand-lg navbar-light bg-light"> <a class="navbar-brand" href="index.php?c=admin&a=grid">Admin</a>
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
    <button name="Add"><a href="<?php echo $urlAction->getUrl('add','config',null,true) ?>">Add Config</a></button>
    <table border='1' width='100%' cellspacing="4">
        <tr>
            <th>Id</th>
            <th>Name</th>
            <th>Code</th>
            <th>Value</th>
            <th>Status</th>
            <th>Created At</th>
            <th>Edit</th>
            <th>Delete</th>
        </tr>
        <?php if(!$configs): ?>
            <tr>
                <td colspan="17">No records found.</td>
            </tr>
            <?php else: ?>
                <?php foreach($configs as $config): ?>
                    <tr>
                        <td>
                            <?php echo $config->configId; ?>
                        </td>
                        <td>
                            <?php echo $config->name; ?>
                        </td>
                        <td>
                            <?php echo $config->code; ?>
                        </td>
                        <td>
                            <?php echo $config->value; ?>
                        </td>
                        <td>
                            <?php echo $config->getStatus($config->status); ?>
                        </td>
                        <td>
                            <?php echo $config->createdAt; ?>
                        </td>
                        <td><a href="<?php echo$urlAction->getUrl('edit','config',['configId' =>  $config->configId],true) ?>">Edit</a></td>
                        <td><a href="<?php echo$urlAction->getUrl('delete','config',['configId' =>  $config->configId],true) ?>">Delete</a></td>
                    </tr>
                    <?php endforeach; ?>
                        <?php endif; ?>
    </table>
</body>

</html>