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
        <input type="text" name="status" placeholder="Enter Status (active-1, inactive-2)" value="<?php echo $r['status']; ?>">

</br>
        <input type="submit" name="submit" value="Update">
        </form>

        <a href="index.php?a=gridAction">Add category</a>

</body>
</html>