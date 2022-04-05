<?php $shippingMethod = $this->getShippingMethod(); ?>
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
									<td></td>
									<td>
										<button class="btn btn-success" type="button" onclick="saveShippingMethod()">Save</button>
										<button class="btn btn-primary" type="button" onclick="shippingMethodCancel()">Cancel</button>
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

	function saveShippingMethod() 
	{
		admin.setForm(jQuery('#indexForm'));
		admin.setUrl("<?php echo $this->getEdit()->getSaveUrl(); ?>");
	    //alert(admin.getUrl());
	    admin.load();
	}

	function shippingMethodCancel() 
	{
	    //alert('button clicked');
	    admin.setUrl("<?php echo $this->getUrl('gridBlock') ?>");
	    admin.load();
	}
</script>