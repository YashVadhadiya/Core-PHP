<?php $vendor = $this->getVendor(); ?>
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
									<td colspan="4"><h1>Personal details</h1></td>
								</tr>

								<tr>
									<td >Id</td>
									<td><input type="text" name="vendor[vendorId]" value="<?php echo $vendor->vendorId ?>" readonly></td>
								</tr>	
								<tr>
									<td >First Name</td>
									<td><input type="text" name="vendor[firstName]" value="<?php echo $vendor->firstName ?>"></td>
								</tr>

								<tr>
									<td >Last Name</td>
									<td><input type="text" name="vendor[lastName]"  value="<?php echo $vendor->lastName ?>"></td>
								</tr>

								<tr>
									<td >Email</td>
									<td><input type="mail" name="vendor[email]"  value="<?php echo $vendor->email ?>"></td>
								</tr>

								<tr>
									<td >Phone</td>
									<td><input type="text" name="vendor[phone]" value="<?php echo $vendor->phone ?>"></td>
								</tr>

								<tr>
									<td >Status</td>
									<td>
										<select name="vendor[status]">
											<?php foreach ($vendor->getStatus() as $key => $value): ?>
												<option <?php if($vendor->status == $key): ?> selected <?php endif; ?> value="<?php echo $key; ?>"> <?php echo $value; ?></option>
											<?php endforeach; ?>
										</select>
									</td>
								</tr>

								<tr>
									<td >&nbsp;</td>
									<td>
										<button class="btn btn-success" type="button" onclick="saveAndNext()">Save & Next</button>
										<button class="btn btn-primary" type="button" onclick="vendorCancel()">Cancel</button>
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

	function saveAndNext() 
	{
		admin.setForm(jQuery('#indexForm'));
		//alert(admin.getUrl());
		admin.setUrl("<?php echo $this->getEdit()->getSaveUrl(); ?>");
		admin.load();
	}

	function vendorCancel() 
	{
		admin.setUrl("<?php echo $this->getUrl('gridBlock') ?>");
		admin.load();
	}
</script>
