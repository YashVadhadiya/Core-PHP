 <?php
require_once('Adapter.php');
$adapter = new Adapter();
$id = $_GET['id'];
$category = $adapter->fetchAll("SELECT * FROM `category` WHERE `id` = $id");
$r = mysqli_fetch_assoc($category);
       
?>

<!DOCTYPE html>
<html>
<head>
	<title>Update Category</title>
</head>

<body>
        <form method="post" action="index.php?a=saveAction">
        <label for="">id</label>
        <input type="text" name="id" value="<?php echo $r['id']; ?>">
        </br>
        <label for="">name</label>
        <input type="text" name="name" value="<?php echo $r['name']; ?>">
</br>
        <label for="">status</label>
        <select name="status">
		<option value="1">Active</option>
		<option value="2">Inactive</option>
	</select>
</br>
        <input type="submit" name="submit" value="Update">
        </form>
        <button type="button"><a href="index.php?a=gridAction">Cancel</a></button>
</body>
</html>