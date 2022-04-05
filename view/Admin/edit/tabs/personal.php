<?php 
$admin = $this->getAdmin();  ?>
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
									<td colspan="4">
										<h1>Admin Details</h1>
									</td>
								</tr>
								<tr>
									<td>Id</td>
									<td>
										<input type="text" name="admin[id]" value="<?php echo $admin->id; ?>" placeholder="You can not insert Id." readonly>
									</td>
								</tr>
								<tr>
									<td>First Name</td>
									<td>
										<input type="text" name="admin[firstName]" value="<?php echo $admin->firstName; ?>">
									</td>
								</tr>
								<tr>
									<td>Last Name</td>
									<td>
										<input type="text" name="admin[lastName]" value="<?php echo $admin->lastName; ?>">
									</td>
								</tr>
								<tr>
									<td>Email</td>
									<td>
										<input type="email" name="admin[email]" value="<?php echo $admin->email; ?>">
									</td>
								</tr>
								<tr>
									<td>Password</td>
									<td>
										<input type="password" name="admin[password]" value="<?php echo $admin->password; ?>">
									</td>
								</tr>
								<tr>
									<td>Status</td>
									<td>
										<select name="admin[status]">
											<?php foreach ($admin->getStatus() as $key => $value): ?>
												<option <?php if($admin->status == $key): ?> selected <?php endif; ?> value="<?php echo $key; ?>"> <?php echo $value; ?></option>
											<?php endforeach; ?>
										</select>
									</td>
								</tr>
							<tr>
								<td></td>
							<td>
								<button class="btn btn-success " type="button" onclick="saveAdmin()">Save</button>
							<button class="btn btn-primary" type="button" onclick="adminCancel()">Cancel</button></td>
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

	function saveAdmin() {
		admin.setForm(jQuery('#indexForm'));
		admin.setUrl("<?php echo $this->getEdit()->getSaveUrl(); ?>");
	    //alert(admin.getUrl());
	    admin.load();
	}

	function adminCancel() {
	     //alert('button clicked');
	     admin.setUrl("<?php echo $this->getUrl('gridBlock') ?>");
	     admin.load();
	 }
	</script>
