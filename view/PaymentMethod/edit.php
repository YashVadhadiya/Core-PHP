<?php $paymentMethod = $this->getPaymentMethod(); ?>

<form action="<?php echo$this->getUrl('save','paymentMethod',null,false) ?>" method="POST">
		<table border="1" width="100%" cellspacing="4">
			<tr>
				<h1>Payment Method</h1>
			</tr>

			<tr>
				<td>Id</td>
				<td><input type="text" name="paymentMethod[methodId]" value="<?php echo $paymentMethod->methodId ; ?>" placeholder="Not for user." readonly></td>
			</tr>

			<tr>
				<td>Name</td>
				<td><input type="text" name="paymentMethod[name]" value="<?php echo $paymentMethod->name ; ?>" ></td>
			</tr>

			<tr>
				<td>Note</td>
				<td><input type="text" name="paymentMethod[note]" value="<?php echo $paymentMethod->note ;?>"></td>
			</tr>

			<tr>
				<td>Status</td>
				<td>
					<select name="paymentMethod[status]" value="<?php echo $paymentMethod->status; ?>">
						<?php foreach ($paymentMethod->getStatus() as $key => $value): ?>
              			<option <?php if($paymentMethod->status == $key): ?> selected <?php endif; ?> value="<?php echo $key; ?>"> <?php echo $value; ?></option>
            			<?php endforeach; ?>
					</select>
				</td>
			</tr>

			<tr>
			<td>&nbsp;</td>
				<td>
					<input type="submit" name="submit" value="Save">
					<button type="button"><a href="<?php echo $this->getUrl('grid','paymentMethod',null,true) ?>">Cancel</a></button>
				</td>
		</tr>
		</table>
	</form>