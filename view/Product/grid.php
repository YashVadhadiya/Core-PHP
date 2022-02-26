<?php $products = $this->getProducts(); ?>
<?php $urlAction = new Controller_Core_Action();?>

<!DOCTYPE html>
<html>
<head>
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
	<title>Product Grid</title>
</head>
<body>
	<!-- this is nav bar code -->
	<nav class="navbar navbar-expand-lg navbar-light bg-light">
		<a class="navbar-brand" href="index.php?c=admin&a=grid">Admin</a>
		<div class="collapse navbar-collapse" id="navbarNav">
			<ul class="navbar-nav">
				<li class="nav-item active">
                    <a class="nav-link" href="<?php echo $urlAction->getUrl('grid','customer',null,true) ?>" name="customer">Customer</a>
                </li>
                <li class="nav-item active">
                    <a class="nav-link" href="<?php echo $urlAction->getUrl('grid','category',null,true) ?>" name="category">Category</a>
                </li>
                <li class="nav-item active">
                    <a class="nav-link" href="<?php echo $urlAction->getUrl('grid','product',null,true) ?>" name="Product">Product</a>
                </li>
                <li class="nav-item active">
                    <a class="nav-link" href="<?php echo $urlAction->getUrl('grid','config',null,true) ?>" name="config">Config</a>
                </li>
			</ul>
		</div>
	</nav>
	<!-- nav bar ends -->
	<button name="Add"><a href="<?php echo $urlAction->getUrl('add','product',null,true) ?>">Add Product</a></button>

	<table border=1 width="100%">

		<tr>
			<th>Id</th>
			<th>Name</th>
			<th>Price</th>
			<th>Quantity</th>
			<th>Status</th>
			<th>Created At</th>
			<th>Updated At</th>
			<th>Base</th>
			<th>Thumb</th>
			<th>Small</th>
			<th>Action</th>
			<th>Media</th>
		</tr>
		<?php if(!$products): ?>
			<tr>
				<td colspan="10">No records found.</td>
			</tr>
		<?php else: ?>
			<?php foreach($products as $product): ?>
				<tr>
					<td><?php echo $product->id; ?></td>
					<td><?php echo $product->name; ?></td>
					<td><?php echo $product->price; ?></td>
					<td><?php echo $product->quantity; ?></td>
					<td><?php echo $product->status; ?></td>
					<td><?php echo $product->createdAt?></td>
					<td><?php echo $product->updatedAt?></td>
					
					<td><?php echo $product->baseImage ?></td>
		    		<td><?php echo $product->thumbImage ?></td>
		    		<td><?php echo $product->smallImage ?></td>

					
					<td><a href="<?php echo$urlAction->getUrl('edit','product',['id' =>  $product->id],true) ?>">Edit</a> 
						<a href="<?php echo$urlAction->getUrl('delete','product',['id' =>  $product->id],true) ?>">Delete</a></td>
					<td><a href="<?php echo$urlAction->getUrl('grid','product_media',['id' =>  $product->id],true) ?>">Media</a></td>
				</tr>
				<?php endforeach; ?>
			<?php endif; ?>
		</table>

	</body>
	</html>