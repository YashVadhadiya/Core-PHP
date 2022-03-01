<?php $vendors = $this->getVendors(); ?>
<?php $urlAction = new Controller_Core_Action();?>

<html>
<head>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <title>vendor Grid</title>
</head>
<body>
    
    <button name="Add"><a href="<?php echo $urlAction->getUrl('add','vendor',null,true) ?>">Add vendor</a></button>

    <table border='1' width='100%' cellspacing="4">
        <tr>
            <th>Id</th>
            <th>First Name</th>
            <th>Last Name</th>
            <th>Email</th>
            <th>Mobile</th>
            <th>Status</th>
            <th>Created At</th>
            <th>Updated At</th>
            <th>Address Id</th>
            <th>Address</th>
            <th>Postal Code</th>
            <th>City</th>
            <th>State</th>
            <th>Country</th>  
            <th>Edit</th>
            <th>Delete</th>
        </tr>
        
        <?php if(!$vendors): ?>
            <tr>
                <td colspan="17">No records found.</td>
            </tr>
        <?php else: ?>
            <?php foreach($vendors as $vendor): ?>
                <tr>
                    <td><?php echo $vendor->vendorId; ?></td>
                    <td><?php echo $vendor->firstName; ?></td>
                    <td><?php echo $vendor->lastName; ?></td>
                    <td><?php echo $vendor->email; ?></td>
                    <td><?php echo $vendor->phone; ?></td>
                    <td><?php echo $vendor->getStatus($vendor->status); ?></td>
                    <td><?php echo $vendor->createdAt; ?></td>
                    <td><?php echo $vendor->updatedAt; ?></td>
                    <td><?php echo $vendor->vendorAddressId; ?></td>
                    <td><?php echo $vendor->address; ?></td>    
                    <td><?php echo $vendor->postalCode; ?></td>
                    <td><?php echo $vendor->city; ?></td>
                    <td><?php echo $vendor->state; ?></td>
                    <td><?php echo $vendor->country; ?></td>

                    <td><a href="<?php echo $urlAction->getUrl('edit','vendor',['id' =>  $vendor->vendorId],true) ?>">Edit</a></td>
                    <td><a href="<?php echo $urlAction->getUrl('delete','vendor',['id' =>  $vendor->vendorId],true) ?>">Delete</a></td>
                </tr>
            <?php endforeach; ?>
        <?php endif; ?>
    </table>
</body>
</html>