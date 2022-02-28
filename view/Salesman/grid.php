<?php $salesmans = $this->getSalesmans(); ?>
<?php $urlAction = new Controller_Core_Action();?>

<!DOCTYPE html>
<html>

<head>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <title>Salesman Grid</title>
</head>

<body>
    <button name="Add"><a href="<?php echo $urlAction->getUrl('add','salesman',null,true) ?>">Add salesman</a></button>
    <table border='1' width='100%' cellspacing="4">
        <tr>
            <th>Id</th>
            <th>First Name</th>
            <th>Last Name</th>
            <th>Email</th>
            <th>Phone</th>
            <th>Status</th>
            <th>Created At</th>
            <th>Updated At</th>
            <th>Edit</th>
            <th>Delete</th>
        </tr>
        <?php if(!$salesmans): ?>
            <tr>
                <td colspan="17">No records found.</td>
            </tr>
            <?php else: ?>
                <?php foreach($salesmans as $salesman): ?>
                    <tr>
                        <td>
                            <?php echo $salesman->salesmanId; ?>
                        </td>
                        <td>
                            <?php echo $salesman->firstName; ?>
                        </td>
                        <td>
                            <?php echo $salesman->lastName; ?>
                        </td>
                        <td>
                            <?php echo $salesman->email; ?>
                        </td>
                        <td>
                            <?php echo $salesman->phone; ?>
                        </td>
                        
                        <td>
                            <?php echo $salesman->getStatus($salesman->status); ?>
                        </td>

                        <td>
                            <?php echo $salesman->createdAt; ?>
                        </td>
                        <td>
                            <?php echo $salesman->updatedAt; ?>
                        </td>
                        <td><a href="<?php echo $urlAction->getUrl('edit','salesman',['id' =>  $salesman->salesmanId],true) ?>">Edit</a></td>
                        <td><a href="<?php echo $urlAction->getUrl('delete','salesman',['id' =>  $salesman->salesmanId],true) ?>">Delete</a></td>
                    </tr>
                    <?php endforeach; ?>
                        <?php endif; ?>
    </table>
</body>

</html>