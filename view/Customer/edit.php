<?php $customer = $this->getCustomer(); ?>
<?php $billingAddress = $this->getBillingAddress();?>
<?php $shippingAddress = $this->getShippingAddress(); ?>
<?php $urlAction = new Controller_Core_Action();?>


	<form method="POST" action="<?php echo$urlAction->getUrl('save','customer',null, false) ?>">
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
				<td colspan="4"><h1>Billing Address</h1></td>
			</tr>
			<tr>
				<td >Id</td>
				<td><input type="text" id="billingAddressId" name="billingaddress[addressId]" value="<?php echo $billingAddress->addressId ?>" readonly></td>
			</tr>	
			<tr>
				<td>Address</td>
				<td><input type="text" id="billingAddress" name="billingaddress[address]"  value="<?php echo $billingAddress->address ?>"></td>
			</tr>
			<tr>
				<td >Postal Code</td>
				<td><input type="text" id="billingPostalCode" name="billingaddress[postalCode]"  value="<?php echo $billingAddress->postalCode ?>"></td>
			</tr>
			<tr>
				<td >City</td>
				<td><input type="text" id="billingCity" name="billingaddress[city]"  value="<?php echo $billingAddress->city ?>"></td>
			</tr>
			<tr>
				<td >State</td>
				<td><input type="text" id="billingState" name="billingaddress[state]"  value="<?php echo $billingAddress->state ?>"></td>
			</tr>
			<tr>
				<td>Country</td>
				<td><input type="text" id="billingCountry" name="billingaddress[country]" value="<?php echo $billingAddress->country ?>"></td>
			</tr>

			<tr>
				<td colspan="4"><h1>Shipping Address</h1></td>
			</tr>

			<tr>
				<th>Same as billing address</th>
    				<td><input type="checkbox" id="checkbox" onclick="SetBilling(this.checked);">
				</td>
			</tr>

			<script type="text/javascript">
			  function SetBilling(checked) {
			    if(checked)
			    {
			      document.getElementById('shippingAddress').value = document.getElementById('billingAddress').value;
			      document.getElementById('shippingPostalCode').value = document.getElementById('billingPostalCode').value;
			      document.getElementById('shippingCity').value = document.getElementById('billingCity').value;
			      document.getElementById('shippingState').value = document.getElementById('billingState').value;
			      document.getElementById('shippingCountry').value = document.getElementById('billingCountry').value;
			    }
			    else
			    {
			      document.getElementById('shippingAddress').value = '';
			      document.getElementById('shippingPostalCode').value = '';
			      document.getElementById('shippingCity').value = '';
			      document.getElementById('shippingState').value = '';
			      document.getElementById('shippingCountry').value = '';
			    }
			  }
			</script>
			
			<tr>
				<td >Id</td>
				<td><input type="text" id="shippingAddressId" name="shippingaddress[addressId]" value="<?php echo $shippingAddress->addressId ?>" readonly></td>
			</tr>	
			<tr>
				<td>Address</td>
				<td><input type="text" id="shippingAddress" name="shippingaddress[address]"  value="<?php echo $shippingAddress->address ?>"></td>
			</tr>
			<tr>
				<td >Postal Code</td>
				<td><input type="text" id="shippingPostalCode" name="shippingaddress[postalCode]"  value="<?php echo $shippingAddress->postalCode ?>"></td>
			</tr>
			<tr>
				<td >City</td>
				<td><input type="text" id="shippingCity" name="shippingaddress[city]"  value="<?php echo $shippingAddress->city ?>"></td>
			</tr>
			<tr>
				<td >State</td>
				<td><input type="text" id="shippingState" name="shippingaddress[state]"  value="<?php echo $shippingAddress->state ?>"></td>
			</tr>
			<tr>
				<td>Country</td>
				<td><input type="text" id="shippingCountry" name="shippingaddress[country]" value="<?php echo $shippingAddress->country ?>"></td>
			<input type="hidden" name="billingaddress[addressId]" value="<?php echo $billingAddress->addressId ?>">
      		<input type="hidden" name="shippingaddress[addressId]" value="<?php echo $shippingAddress->addressId ?>">
			</tr>

			<tr>
				<td >&nbsp;</td>
				<td>
					<input type="submit" value="Save" name="edit">
					<button type="button"><a href="<?php echo $urlAction->getUrl('grid','customer',null,true) ?>">Cancel</a></button>
				</td>
			</tr>


			
		</table>	
	</form>