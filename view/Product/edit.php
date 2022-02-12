<?php
require_once('Model/Core/Adapter.php');
$adapter = new Model_Core_Adapter();
$id = $_GET['id'];
$product = $adapter->fetchRow("SELECT * FROM `product` WHERE `id` = $id");

$name = $product['name'];
$price = $product['price'];
$quantity = $product['quantity'];
$status = $product['status'];

?>
<!DOCTYPE html>
<html>
<head>
	<title>Product Update</title>
</head>

<body>
        <form method="post" action="index.php?c=product&a=save">
                <label for="">id</label>
                <input type="text" name="id" value="<?php echo $id; ?>">
        </br>
        <label for="">name</label>
        <input type="text" name="name" value="<?php echo $name; ?>">
</br>
<label for="">price</label>
<input type="text" name="price" value="<?php echo $price; ?>"> 
</br>    
<label for="">quantity</label>
<input type="text" name="quantity" value="<?php echo $quantity; ?>">   
</br>
<label for="">status</label>
<select name="status">
        <option value="1">Active</option>
        <option value="2">Inactive</option>
</select>
</br>
<input type="submit" name="submit" value="Update">
</form>

<a href="index.php?c=product&a=grid">Add Product</a>

</body>
</html>