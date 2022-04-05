<?php $salesmanCustomers = $this->getSalesmanWithCustomer(); //print_r($salesmanCustomers) ?>
<?php $salesmanWithoutCustomer = $this->getSalesmanWithoutCustomer(); //print_r($salesmanWithoutCustomer) ?>


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
									<th>Customer ID</th>
									<th>First Name</th>
									<th>Last Name</th>
									<th>Email</th>
									<th>Action</th>
									<th>Price</th>
								</tr>
								<?php if(!$salesmanCustomers): ?>
									<tr>No Customer</tr>
								<?php else: ?>
									<?php foreach ($salesmanCustomers as $salesmanCustomer): ?>
										<tr>
											<td><?php echo $salesmanCustomer->id; ?></td>
											<td><?php echo $salesmanCustomer->firstName; ?></td>
											<td><?php echo $salesmanCustomer->lastName; ?></td>
											<td><?php echo $salesmanCustomer->email; ?></td>
											<td><input type="checkbox" name="salesmanCustomer[customer][]" value="" disabled></td>

											<td>
												<button type="button" value="<?php echo $salesmanCustomer->id;?>" class="price btn btn-success">Price</button>
											</tr>
										<?php endforeach; ?>
									<?php endif;?>
								</table>
								<br>
								<br>
								<br>
								<table id="example2" class="table table-bordered table-hover">

									<tr>
										<th>Customer ID</th>
										<th>First Name</th>
										<th>Last Name</th>
										<th>Email</th>
										<th>Action</th>
									</tr>
									<?php if(!$salesmanWithoutCustomer): ?>
										<tr>No Customer</tr>
									<?php else: ?>
										<?php foreach ($salesmanWithoutCustomer as $salesmanCustomer): ?>
											<tr>
												<td><?php echo $salesmanCustomer->id; ?></td>
												<td><?php echo $salesmanCustomer->firstName; ?></td>
												<td><?php echo $salesmanCustomer->lastName; ?></td>
												<td><?php echo $salesmanCustomer->email; ?></td>
												<td><input type="checkbox" name="salesmanCustomer[customerNo][]" value="<?php echo $salesmanCustomer->id ?>"></td>

											</tr>
										<?php endforeach; ?>
									<?php endif;?>

									<td>
										<button class="btn btn-success" type="button" onclick="saveCustomerPrice()">Save</button>
									</td>
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

	function saveCustomerPrice() 
	{
		admin.setForm(jQuery('#indexForm'));
	//alert(admin.getForm());
	admin.setUrl("<?php echo $this->getUrl('save','salesman_Customer',null,false)?>");
	//alert(admin.getUrl());
	admin.load();
	}
	function customerPrice() 
	{
		admin.setForm(jQuery('#indexForm'));
		admin.setUrl("<?php echo $this->getUrl('gridBlock','customer_price',['id' => Ccc::getFront()->getRequest()->getRequest('id') , 'customerId' => $salesmanCustomer->id],true); ?>");
		//alert(admin.getUrl());
		admin.load();
	}

	$('.price').click(function()
	{
		var data = $(this).val();
		admin.setForm(jQuery('#indexForm'));
		admin.setUrl("<?php echo $this->getUrl('addBlock','salesman',['tab' => 'price'],false)?>&customerId="+data);
//alert(admin.getUrl());
		admin.load();
	})
</script>