<?php $customers = $this->getCustomers(); ?>
<html>
<head>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <title>Customer Grid</title>
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
    <button name="Add"><a href="index.php?c=customer&a=add">Add Customer</a></button>

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
            <th>Billing</th>
            <th>Shipping</th>   
            <th>Edit</th>
            <th>Delete</th>
        </tr>
        
        <?php if(!$customers): ?>
            <tr>
                <td colspan="17">No records found.</td>
            </tr>
        <?php else: ?>
            <?php foreach($customers as $customer): ?>
                <tr>
                    <td><?php echo $customer['id']; ?></td>
                    <td><?php echo $customer['firstName']; ?></td>
                    <td><?php echo $customer['lastName']; ?></td>
                    <td><?php echo $customer['email']; ?></td>
                    <td><?php echo $customer['phone']; ?></td>
                    <td><?php echo $customer['status']; ?></td>
                    <td><?php echo $customer['createdAt']; ?></td>
                    <td><?php echo $customer['updatedAt']; ?></td>
                    <td><?php echo $customer['addressId']; ?></td>
                    <td><?php echo $customer['address']; ?></td>    
                    <td><?php echo $customer['postalCode']; ?></td>
                    <td><?php echo $customer['city']; ?></td>
                    <td><?php echo $customer['state']; ?></td>
                    <td><?php echo $customer['country']; ?></td>
                    <td><?php echo $customer['billing']; ?></td>
                    <td><?php echo $customer['shipping']; ?></td>

                    <td><a href="index.php?c=customer&a=edit&id=<?php echo $customer['id'] ?>">Edit</a></td>
                    <td><a href="index.php?c=customer&a=delete&id=<?php echo $customer['id'] ?>">Delete</a></td>
                </tr>
            <?php endforeach; ?>
        <?php endif; ?>
    </table>
</body>
</html>