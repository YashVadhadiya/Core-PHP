<?php $salesmanCustomers = $this->getSalesmanCustomers(); ?>
<?php $customerWithoutSalesmans = $this->getCustomerWithoutSalesman(); ?>
<?php $urlAction = new Controller_Core_Action();?>

<form method="POST" action="<?php echo $urlAction->getUrl('save',null, null, false) ?>">

<table border="1" width="100%">
	
	<tr>
		<th>Customer ID</th>
		<th>First Name</th>
		<th>Last Name</th>
		<th>Email</th>
		<th>Selected Customer</th>
		<th>Price</th>
	</tr>
	<?php if(!$salesmanCustomers): ?>
		<tr>
			<td>No customer.</td>
		</tr>
	<?php else: ?>

	<?php foreach ($salesmanCustomers as $salesmanCustomer): ?>
		<tr>
			<td><?php echo $salesmanCustomer->id; ?></td>
			<td><?php echo $salesmanCustomer->firstName; ?></td>
			<td><?php echo $salesmanCustomer->lastName; ?></td>
			<td><?php echo $salesmanCustomer->email; ?></td>
			<td><input type="checkbox" name="salesmanCustomer[customer][]" value="" disabled></td>
			<td><a href="<?php echo $urlAction->getUrl('grid','customer_price',['id' => Ccc::getFront()->getRequest()->getRequest('id') , 'customerId' => $salesmanCustomer->id],true); ?>">Customer Product Price</a></td>

		</tr>
	<?php endforeach; ?>
	<?php endif; ?>
	<td><input type="hidden" name="salesmanCustomer[customerId]" value="<?php echo $salesmanCustomer->id; ?>"></td>
		<tr>
			<th colspan="5">Other available customer</th>
		</tr>

	<?php if(!$customerWithoutSalesmans): ?>
		<tr>
			<td>No record.</td>
		</tr>
	<?php else: ?>
	<?php foreach ($customerWithoutSalesmans as $customerWithoutSalesman): ?>
		<tr>
			<td><?php echo $customerWithoutSalesman->id; ?></td>
			<td><?php echo $customerWithoutSalesman->firstName; ?></td>
			<td><?php echo $customerWithoutSalesman->lastName; ?></td>
			<td><?php echo $customerWithoutSalesman->email; ?></td>
			<td><input type="checkbox" name="salesmanCustomer[customerWithoutSalesman][]" value="<?php echo $customerWithoutSalesman->id; ?>"></td>
		</tr>
		<?php endforeach; ?>
	<?php endif; ?>

		<td colspan="5">
			<input type="submit" value="Save" name="edit">
			<button type="button"><a href="<?php echo $urlAction->getUrl('grid','salesman',null,false) ?>">Cancel</a></button>
		</td>
</table>
</form>