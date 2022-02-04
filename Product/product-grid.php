<?php
 require_once('Adapter.php');
 $adapter = new Adapter();
 $products = $adapter->fetchAll("SELECT * FROM `product`");

?>
<!DOCTYPE html>
<html>
<head>
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
				
				<td><a href="index.php?a=editAction&id=<?php echo $product['id']; ?>">Update</a> 
				<a href="index.php?a=deleteAction&id=<?php echo $product['id']; ?>">Delete</a></td>
			</tr>
			<?php endforeach; ?>
			<?php endif; ?>
		</table>
        <a href="index.php?a=addAction" class="add">Add Product</a>

</body>
</html>