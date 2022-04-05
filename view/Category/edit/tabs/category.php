<?php $category = $this->getCategories();?>
<?php $getCategoryWithPath = $this->getCategoryWithPath(); ?>
<?php $result = $getCategoryWithPath;  ?>
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
									<td>Id</td>
									<td><input type="text" name="category[categoryId]" value="<?php echo $category->categoryId; ?>" placeholder="Not for user." readonly></td>
								</tr>
								<tr>
									<td>Category</td>
									<td>
										<select name="category[parentId]">
											<option value="">Main Category</option>
											<?php foreach ($result as $key => $row) { ?>
												<option value="<?php echo $key; ?>" 
													<?php if ($category->parentId == $key) {
														echo "selected";
													} ?>><?php echo $row; ?>
												</option>
												<?php
											} 

											?>
										</select>
									</td>
								</tr>

								<tr>
									<td>Status</td>
									<td><select name="category[status]" value="<?php echo $category->status;?>">
										<?php foreach ($category->getStatus() as $key => $value): ?>
											<option <?php if($category->status == $key): ?> selected <?php endif; ?> value="<?php echo $key; ?>"> <?php echo $value; ?></option>
										<?php endforeach; ?>
									</select>
								</td>
							</tr>

							<tr>
								<td>Category Name</td>
								<td>
									<input type="text" name="category[categoryName]" value="<?php echo $category->categoryName; ?>">
								</td>
							</tr>

							<tr>
								<td>&nbsp;</td>
								<td>
									<button class="btn btn-success" type="button" onclick="saveAndNext()">Save and Next</button>
									<button class="btn btn-primary" type="button" onclick="customerCancel()">Cancel</button>
								</td>
							</tr>    
						</div>
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
		admin.setUrl("<?php echo $this->getEdit()->getSaveUrl();?>");
		//alert(admin.getUrl());
		admin.load();
	}

	function customerCancel() 
	{
		admin.setUrl("<?php echo $this->getUrl('gridBlock') ?>");
		admin.load();
	}
</script>