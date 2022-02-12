<?php
require_once('Model/Core/Adapter.php');
$adapter = new Model_Core_Adapter();
$products = $adapter->fetchAll("SELECT * FROM `product`");

?>
<!DOCTYPE html>
<html>
<head>
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
	<title>Product Grid</title>
</head>
<style>
	table {
		font-family: arial, sans-serif;
		border-collapse: collapse;
		width: 100%;
	}

	tr, th {
		border: 1px solid #dddddd;
		text-align: left;
		padding: 10px;
	}

	tr:nth-child(even) {
		background-color: #dddddd;
	}
</style>
<body>
	<!-- this is nav bar code -->
	<nav class="navbar navbar-expand-lg navbar-light bg-light">
		<a class="navbar-brand" href="index.php?c=admin&a=grid">Admin</a>
		<div class="collapse navbar-collapse" id="navbarNav">
			<ul class="navbar-nav">
				<li class="nav-item active">
					<a class="nav-link" href="index.php?c=customer&a=grid" name="customer">Customer</a>
				</li>
				<li class="nav-item">
					<a class="nav-link" href="index.php?c=category&a=grid" name="category">Category</a>
				</li>
				<li class="nav-item">
					<a class="nav-link" href="index.php?c=product&a=grid" name="Product">Product</a>
				</li>
			</ul>
		</div>
	</nav>
	<!-- nav bar ends -->
	<button name="Add"><a href="index.php?c=product&a=add">Add Product</a></button>

	<table border=1>

		<tr>
			<th>Id</th>
			<th>Name</th>
			<th>Price</th>
			<th>Quantity</th>
			<th>Status</th>
			<th>Created At</th>
			<th>Updated At</th>
			<th>Action</th>
		</tr>
		<?php if(!$products): ?>
			<tr>
				<td colspan="10">No records found.</td>
			</tr>
		<?php else: ?>
			<?php foreach($products as $product): ?>
				<tr>
					<td><?php echo $product['id']; ?></td>
					<td><?php echo $product['name']; ?></td>
					<td><?php echo $product['price']; ?></td>
					<td><?php echo $product['quantity']; ?></td>
					<td><?php echo $product['status']; ?></td>
					<td><?php echo $product['createdAt']?></td>
					<td><?php echo $product['updatedAt']?></td>
					
					<td><a href="index.php?c=product&a=edit&id=<?php echo $product['id']; ?>">Edit</a> 
						<a href="index.php?c=product&a=delete&id=<?php echo $product['id']; ?>">Delete</a></td>
					</tr>
				<?php endforeach; ?>
			<?php endif; ?>
		</table>

	</body>
	</html>