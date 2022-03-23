<?php $customer = $this->getCustomer(); ?>
<?php $billingAddress = $this->getBillingAddress();?>
<?php $shippingAddress = $this->getShippingAddress(); ?>



	<form method="POST" action="<?php echo$this->getUrl('save','customer',null, false) ?>">
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
				<td>Address</td>
				<td><input type="text" id="billingAddress" name="billingAddress[address]"  value="<?php echo $billingAddress->address ?>"></td>
			</tr>
			<tr>
				<td >Postal Code</td>
				<td><input type="text" id="billingPostalCode" name="billingAddress[postalCode]"  value="<?php echo $billingAddress->postalCode ?>"></td>
			</tr>
			<tr>
				<td >City</td>
				<td><input type="text" id="billingCity" name="billingAddress[city]"  value="<?php echo $billingAddress->city ?>"></td>
			</tr>
			<tr>
				<td >State</td>
				<td><input type="text" id="billingState" name="billingAddress[state]"  value="<?php echo $billingAddress->state ?>"></td>
			</tr>
			<tr>
				<td>Country</td>
				<td><input type="text" id="billingCountry" name="billingAddress[country]" value="<?php echo $billingAddress->country ?>"></td>
			</tr>

			<tr>
			<td colspan="2"><input type="checkbox" name="sameShipping" <?php if($billingAddress->same == 1):?> checked <?php endif; ?> onclick="showHide(this)">Mark Shipping as Billing</td>
		</tr>
		</table>


			<script type="text/javascript">
			function showHide(checkbox) {
				var shippingAddress = document.getElementById('shipping');
				shippingAddress.style.display = checkbox.checked ? "none" : "block";
			}
		</script>

		<div id='shipping' <?php if($billingAddress->same != 1): ?> style="display:block;" <?php else: ?> style="display:none;" <?php endif; ?>>
	<table border="1" width="100%" cellspacing="4">


			<tr>
				<td colspan="4"><h1>Shipping Address</h1></td>
			</tr>
				
			<tr>
				<td>Address</td>
				<td><input type="text" id="shippingAddress" name="shippingAddress[address]"  value="<?php echo $shippingAddress->address ?>"></td>
			</tr>
			<tr>
				<td >Postal Code</td>
				<td><input type="text" id="shippingPostalCode" name="shippingAddress[postalCode]"  value="<?php echo $shippingAddress->postalCode ?>"></td>
			</tr>
			<tr>
				<td >City</td>
				<td><input type="text" id="shippingCity" name="shippingAddress[city]"  value="<?php echo $shippingAddress->city ?>"></td>
			</tr>
			<tr>
				<td >State</td>
				<td><input type="text" id="shippingState" name="shippingAddress[state]"  value="<?php echo $shippingAddress->state ?>"></td>
			</tr>
			<tr>
				<td>Country</td>
				<td><input type="text" id="shippingCountry" name="shippingAddress[country]" value="<?php echo $shippingAddress->country ?>"></td>
			</tr>

			<tr>
				<td >&nbsp;</td>
				<td>
				</td>
			</tr>


			
		</table>
		</div>
					<input type="submit" value="Save" name="edit">
					<button type="button"><a href="<?php echo $this->getUrl('grid','customer',null,true) ?>">Cancel</a></button>

	</form>