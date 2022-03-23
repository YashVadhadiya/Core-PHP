<?php $order = $this->getOrder(); ?>

<form method="POST" action="<?php echo $this->getUrl('save','order',null, false) ?>">
	<table border="1" width="100%" cellspacing="4">
		<!-- this is used for personal data -->
		<tr>
			<td colspan="4">
				<h1>Order details</h1>
			</td>
		</tr>
		<tr>
			<td>Id</td>
			<td>
				<input type="text" name="order[orderId]" value="<?php echo $order->orderId; ?>" readonly>
			</td>
		</tr>
		<tr>
			<td>State</td>
			<td><select name="order[state]">
                <?php foreach ($order->getState() as $key => $value): ?>
                <option <?php if($order->state == $key): ?> selected <?php endif; ?> value="<?php echo $key; ?>"> <?php echo $value; ?></option>
                    <?php endforeach; ?>
            </select></td>
		</tr>

		<tr>
			<td>Status</td>
            <td><select name="order[status]">
                <?php foreach ($order->getStatus() as $key => $value): ?>
                <option <?php if($order->status == $key): ?> selected <?php endif; ?> value="<?php echo $key; ?>"> <?php echo $value; ?></option>
                    <?php endforeach; ?>
            </select></td>
		</tr>
		<tr>
			<td>&nbsp;</td>
			<td>
				<input type="submit" value="Save" name="edit">
				<button type="button"><a href="<?php echo $this->getUrl('grid','order',null,true) ?>">Cancel</a></button>
			</td>
		</tr>
	</table>
</form>