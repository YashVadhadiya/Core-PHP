<?php $customers = $this->getCustomers(); ?>
<?php $urlAction = new Controller_Core_Action();?>
    
    <button name="Add"><a href="<?php echo $urlAction->getUrl('add','customer',null,true) ?>">Add Customer</a></button>

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
                    <td><?php echo $customer->id; ?></td>
                    <td><?php echo $customer->firstName; ?></td>
                    <td><?php echo $customer->lastName; ?></td>
                    <td><?php echo $customer->email; ?></td>
                    <td><?php echo $customer->phone; ?></td>
                    <td><?php echo $customer->getStatus($customer->status); ?></td>
                    <td><?php echo $customer->createdAt; ?></td>
                    <td><?php echo $customer->updatedAt; ?></td>
                    <td><?php echo $customer->addressId; ?></td>
                    <td><?php echo $customer->address; ?></td>    
                    <td><?php echo $customer->postalCode; ?></td>
                    <td><?php echo $customer->city; ?></td>
                    <td><?php echo $customer->state; ?></td>
                    <td><?php echo $customer->country; ?></td>
                    <td><?php echo $customer->billing; ?></td>
                    <td><?php echo $customer->shipping; ?></td>

                    <td><a href="<?php echo$urlAction->getUrl('edit','customer',['id' =>  $customer->id],true) ?>">Edit</a></td>
                    <td><a href="<?php echo$urlAction->getUrl('delete','customer',['id' =>  $customer->id],true) ?>">Delete</a></td>
                </tr>
            <?php endforeach; ?>
        <?php endif; ?>
    </table>