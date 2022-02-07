<?php
 require_once ('Adapter.php');
 $adapter = new Adapter();
 $categories = $adapter->fetchAll("SELECT * FROM `category`");
?>
<!DOCTYPE html>
<html>
<head>
	<title>Category Grid</title>
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
<button name="Add"><a href="index.php?a=addAction">Add Customer</a></button>
		<table border=1>

			<tr>
				<th>Id</th>
				<th>Name</th>
				<th>Status</th>
				<th>Created At</th>
				<th>Updated At</th>
                <th>Action</th>
			</tr>
			 <?php if(!$categories): ?> 
			 <tr>
        		<td colspan="10">No records found.</td>
    		</tr>
			<?php else: ?>
			<?php foreach($categories as $category): ?>
			<tr>
				<td><?php echo $category['id']; ?></td>
				<td><?php echo $category['name']; ?></td>
				<td><?php echo $category['status']; ?></td>
				<td><?php echo $category['createdAt']?></td>
				<td><?php echo $category['updatedAt']?></td>
				<td><a href="index.php?a=editAction&id=<?php echo $category['id']; ?>">Edit</a> 
				<a href="index.php?a=deleteAction&id=<?php echo $category['id']; ?>">Delete</a></td>
			</tr>
			<?php endforeach; ?>
			<?php endif; ?>
		</table>
		

</body>
</html>