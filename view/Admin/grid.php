<?php $admins = $this->getAdmins(); ?>
<?php $urlAction = new Controller_Core_Action();?>

<!DOCTYPE html>
<html>

<head>
    <title>Admin Grid</title>
</head>

<body>

    <button name="Add"><a href="<?php echo $urlAction->getUrl('add','admin',null,true) ?>">Add admin</a></button>
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
                        <td><a href="<?php echo $urlAction->getUrl('edit','admin',['id' =>  $admin->id],true) ?>">Edit</a></td>
                        <td><a href="<?php echo $urlAction->getUrl('delete','admin',['id' =>  $admin->id],true) ?>">Delete</a></td>
                    </tr>
                    <?php endforeach; ?>
                        <?php endif; ?>
    </table>
</body>

</html>