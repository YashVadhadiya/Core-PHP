<?php
require_once('Adapter.php');
$adapter = new Adapter();
$id = $_GET['id'];
$product = $adapter->fetchAll("SELECT * FROM `product` WHERE `id` = $id");
$r = mysqli_fetch_assoc($product);
      
?>
<!DOCTYPE html>
<html>
<head>
	<title>Product Update</title>
</head>

<body>
        <form method="post" action="index.php?a=saveAction">
        <label for="">id</label>
        <input type="text" name="id" value="<?php echo $r['id']; ?>">
</br>
        <label for="">name</label>
        <input type="text" name="name" value="<?php echo $r['name']; ?>">
</br>
        <label for="">price</label>
        <input type="text" name="price" value="<?php echo $r['price']; ?>"> 
</br>    
        <label for="">quantity</label>
        <input type="text" name="quantity" value="<?php echo $r['quantity']; ?>">   
</br>
        <label for="">status</label>
        <select name="status">
                <option value="1">Active</option>
                <option value="2">Inactive</option>
        </select>
</br>
        <input type="submit" name="submit" value="Update">
        </form>

        <a href="index.php?a=gridAction">Add Product</a>

</body>
</html>