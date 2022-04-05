<?php// print_r(Ccc::getBlock('Cart_CartShow')); ?>

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
									<td colspan="2"><?php echo  Ccc::getBlock('Cart_CustomerDetails')->toHtml();?></td>
								</tr>
								<tr>
									<td ><?php echo  Ccc::getBlock('Cart_PaymentMethod')->toHtml();?></td>
									<td ><?php echo  Ccc::getBlock('Cart_ShippingMethod')->toHtml();?></td>
								</tr>
								<tr>
									<td colspan="2"><?php echo  Ccc::getBlock('Cart_Address')->toHtml();?></td>
								</tr>
								<tr>
									<td colspan="2"><?php echo  Ccc::getBlock('Cart_Item')->toHtml();?></td>
								</tr>
								<tr>
									<td colspan="2"><?php echo  Ccc::getBlock('Cart_placeOrder')->toHtml();?></td>
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