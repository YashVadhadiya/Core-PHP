<?php $page = $this->getPage(); ?>
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
										<h1>Page Details</h1></td>
									</tr>
									<tr>
										<td>Id</td>
										<td>
											<input type="text" name="page[pageId]" value="<?php echo $page->pageId; ?>" readonly>
										</td>
									</tr>
									<tr>
										<td>Name</td>
										<td>
											<input type="text" name="page[name]" value="<?php echo $page->name; ?>">
										</td>
									</tr>
									<tr>
										<td>Code</td>
										<td>
											<input type="text" name="page[code]" value="<?php echo $page->code; ?>">
										</td>
									</tr>
									<tr>
										<td>Content</td>
										<td>
											<input type="text" name="page[content]" value="<?php echo $page->content; ?>">
										</td>
									</tr>
									<tr>
										<td>Status</td>
										<td>
											<select name="page[status]">
												<?php foreach ($page->getStatus() as $key => $value): ?>
													<option <?php if($page->status == $key): ?> selected <?php endif; ?> value="<?php echo $key; ?>"> <?php echo $value; ?></option>
												<?php endforeach; ?>
											</select>
										</td>
									</tr>
									<tr>
										<td></td>
										<td>
											<button class="btn btn-success" type="button" onclick="savePage()">Save</button>
											<button class="btn btn-primary" type="button" onclick="pageCancel()">Cancel</button>
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

		function savePage() 
		{
			admin.setForm(jQuery('#indexForm'));
			admin.setUrl("<?php echo $this->getEdit()->getSaveUrl(); ?>");
//alert(admin.getUrl());
admin.load();
}

function pageCancel() 
{
	//alert('button clicked');
	admin.setUrl("<?php echo $this->getUrl('gridBlock') ?>");
	admin.load();
}
</script>
