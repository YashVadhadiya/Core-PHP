<?php $productsWithPercentage = $this->getProducts(); //print_r($productsWithPercentage); die; ?>
<?php $products = $productsWithPercentage['products'];  //print_r($products);// die;?>
<?php $percentage = $productsWithPercentage['percentage']; //print_r($percentage); die; ?>


<div class="content-wrapper">
	<section class="content">
		<div class="container-fluid">
			<div class="row">
				<div class="col-12">
					<div class="card">

						<!-- /.card-header -->
						<div class="card-body">
							<?php $prices = $this->getPrices(); //print_r($prices); //die; ?>
							<table id="example2" class="table table-bordered table-hover">

								<tr>
									<th>Product ID</th>
									<th>Name</th>
									<th>Sku</th>
									<th>Price</th>
									<th>Salesman Price</th>
									<th>Customer Price</th>
								</tr>
								<?php 

								if(!$products):
									echo '<tr><td colspan="6">No Records available</td></tr>';
								else:
									foreach($products as $product):
										?>
										<tr>
											<td><?php echo $product->id; ?></td>
											<td><?php echo $product->name; ?></td>
											<td><?php echo $product->sku; ?></td>
											<td><?php echo $product->price; ?></td>
											<td><?php echo $discountPrice = $product->price - ($product->price * $percentage) / 100; ?></td>
											<td>
												<input type="number" name="<?php if($prices): if(array_key_exists($product->id, $prices)):?> price[exists][<?php echo $product->id; ?>] <?php else: ?> price[new][<?php echo $product->id; ?>] <?php endif; endif;?> price[new][<?php echo $product->id; ?>] ?>" step="0.01" min="<?php echo $discountPrice; ?>" max="<?php echo $product->price; ?>" value="<?php echo $prices[$product->id]; ?>" required>
											</td>
										</tr>
									<?php endforeach;
								endif;
								?>
								<tr>
									<td colspan="6">
										<button class="btn btn-success" type="button" onclick="savePrice()">Save</button>
										<button class="btn btn-primary" type="button" onclick="cancelPrice()">Cancel</button>
									</td>
								</tr>
							</form>

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

	function savePrice() 
	{
		admin.setForm(jQuery('#indexForm'));
		admin.setUrl("<?php echo $this->getUrl('save','customer_price',null,false); ?>");
		//alert(admin.getUrl());
		admin.load();
	}

	function cancelPrice() 
	{
		admin.setUrl("<?php echo $this->getUrl('gridBlock') ?>");
		admin.load();
	}
</script>