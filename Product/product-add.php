<!DOCTYPE html>
<html>
<head>
	<title>Product Insert</title>
</head>

<body>
    <div class="form-tbl">
	<form method="post" action="index.php?a=saveAction">
</br>
        <label for="">name</label>
        <input type="text" name="name" placeholder="Enter Name">
</br>
        <label for="">price</label>
        <input type="text" name="price" placeholder="Enter Price">
</br>
        <label for="">quantity</label>
        <input type="text" name="quantity" placeholder="Enter Quantity">
</br>
        <label for="">status</label>
        <input type="text" name="status" placeholder="Enter Status (active-1, inactive-2)">
</br>
        <input type="submit" name="submit" value="Submit">
        <a href="index.php?a=gridAction" type="submit">View Database</a>

        </form>
        </div>
    </body>
</html>