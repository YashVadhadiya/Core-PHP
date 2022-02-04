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
        <input type="text" name="status" placeholder="Enter Status (active-1, inactive-2)" value="<?php echo $r['status']; ?>">
</br>    
        <label for="">Created At (date and time):</label>
        <input type="datetime-local" id="createdAt" name="createdAt" value="<?php echo $r['createdAt']; ?>">
</br>
        <label for="">Updated At (date and time):</label>
        <input type="datetime-local" id="updatedAt" name="updatedAt" value="<?php echo $r['UpdatedAt']; ?>">
</br>
        <input type="submit" name="submit" value="Update">
        </form>

        <a href="index.php?a=gridAction">Add Product</a>

</body>
</html>