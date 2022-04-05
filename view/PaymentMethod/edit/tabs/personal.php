<?php $paymentMethod = $this->getPaymentMethod(); ?>
<div class="content-wrapper">
	<section class="content">
		<div class="container-fluid">
			<div class="row">
				<div class="col-12">
					<div class="card">

						<!-- /.card-header -->
						<div class="card-body">
							<table id="example2" class="table table-bordered table-hover">
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
									<td></td>
									<td>
										<button class="btn btn-success" type="button" onclick="savePaymentMethod()">Save</button>
										<button class="btn btn-primary" type="button" onclick="paymentMethodCancel()">Cancel</button>
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

	function savePaymentMethod() {
		admin.setForm(jQuery('#indexForm'));
		admin.setUrl("<?php echo $this->getEdit()->getSaveUrl(); ?>");
	    //alert(admin.getUrl());
	    admin.load();
	}

	function paymentMethodCancel() {
	     //alert('button clicked');
	     admin.setUrl("<?php echo $this->getUrl('gridBlock') ?>");
	     admin.load();
	 }
	</script>
