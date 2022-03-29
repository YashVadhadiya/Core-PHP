<?php $customer = $this->getCustomer(); ?>
<?php //$billingAddress = $this->getBillingAddress();?>
<?php //$shippingAddress = $this->getShippingAddress(); ?>

	<!-- <form method="POST" action="<?php //echo$this->getUrl('save','customer',null, false) ?>"> -->
		<table border="1" width="100%" cellspacing="4">

			<tr>
				<td colspan="4"><h1>Personal details</h1></td>
			</tr>

			<tr>
				<td >Id</td>
				<td><input type="text" placeholder="You cannot insert Id." name="customer[id]" value="<?php echo $customer->id ?>" readonly></td>
			</tr>	
			<tr>
				<td >First Name</td>
				<td><input type="text" name="customer[firstName]" value="<?php echo $customer->firstName ?>"></td>
			</tr>
			
			<tr>
				<td >Last Name</td>
				<td><input type="text" name="customer[lastName]"  value="<?php echo $customer->lastName ?>"></td>
			</tr>

			<tr>
				<td >Email</td>
				<td><input type="mail" name="customer[email]"  value="<?php echo $customer->email ?>"></td>
			</tr>

			<tr>
				<td >Phone</td>
				<td><input type="text" name="customer[phone]" value="<?php echo $customer->phone ?>"></td>
			</tr>
			<tr>
				<td >Status</td>
				<td>
					<select name="customer[status]">
						<?php foreach ($customer->getStatus() as $key => $value): ?>
              			<option <?php if($customer->status == $key): ?> selected <?php endif; ?> value="<?php echo $key; ?>"> <?php echo $value; ?></option>
            				<?php endforeach; ?>
					</select>
				</td>
			</tr>

			

			<tr>
				<td >&nbsp;</td>
				<td>
					<button type="submit">Save & Next</button>
					<button type="button"><a href="<?php echo $this->getUrl('grid','customer',null,true) ?>">Cancel</a></button>
				</td>
			</tr>


			
					
		</table>