<?php $order = $this->getOrder(); ?>

<div class="content-wrapper">
	<section class="content">
		<div class="container-fluid">
			<div class="row">
				<div class="col-12">
					<div class="card">

						<!-- /.card-header -->
						<div class="card-body">
							<table id="example2" class="table table-bordered table-hover">
								<!-- this is used for personal data -->
								<tr>
									<td colspan="4">
										<h1>Order Details</h1>
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
										<button class="btn btn-success" type="button" onclick="saveForm()">Save</button>
										<button class="btn btn-primary" type="button" onclick="cancelForm()">Cancel</button>
									</td>
								</tr>
							</table>

						</div>
						<!-- /.card-body -->
					</div>
					<!-- /.card -->
				</div>
				<!-- /.col -->
			</div>
			<!-- /.row -->
		</div>
		<!-- /.container-fluid -->
	</section>
</div>

<script type="text/javascript">
	function saveForm() 
	{
		//alert('button clicked');
		admin.setForm(jQuery('#indexForm'));
		admin.setUrl("<?php echo $this->getEdit()->getSaveUrl(); ?>");
		admin.load();
	}

	function cancelForm() 
	{
		admin.setUrl("<?php echo $this->getUrl('gridBlock') ?>");
		admin.load();
	}
</script>
