<?php $shippingMethod = $this->getShippingMethod(); ?>

<form action="<?php echo$this->getUrl('save','shippingMethod',null,false) ?>" method="POST">
		<table border="1" width="100%" cellspacing="4">
			<tr>
				<h1> Shipping Method Information</h1>
			</tr>

			<tr>
				<td>Id</td>
				<td><input type="text" name="shippingMethod[methodId]" value="<?php echo $shippingMethod->methodId ; ?>" placeholder="Not for user." readonly></td>
			</tr>

			<tr>
				<td>Name</td>
				<td><input type="text" name="shippingMethod[name]" value="<?php echo $shippingMethod->name ; ?>" ></td>
			</tr>

			<tr>
				<td>Note</td>
				<td><input type="text" name="shippingMethod[note]" value="<?php echo $shippingMethod->note ;?>"></td>
			</tr>

			<tr>
				<td>Price</td>
				<td><input type="text" name="shippingMethod[price]" value="<?php echo $shippingMethod->price ;?>"></td>
			</tr>

			<tr>
				<td>Status</td>
				<td>
					<select name="shippingMethod[status]" value="<?php echo $shippingMethod->status; ?>">
						<?php foreach ($shippingMethod->getStatus() as $key => $value): ?>
              			<option <?php if($shippingMethod->status == $key): ?> selected <?php endif; ?> value="<?php echo $key; ?>"> <?php echo $value; ?></option>
            			<?php endforeach; ?>
					</select>
				</td>
			</tr>

			<tr>
			<td>&nbsp;</td>
				<td>
					<input type="submit" name="submit" value="Save">
					<button type="button"><a href="<?php echo $this->getUrl('grid','shippingMethod',null,true) ?>">Cancel</a></button>
				</td>
		</tr>
		</table>
	</form>
