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
        <select>
            <option value="1">Active</option>
            <option value="2">Inactive</option>
        </select>
</br>
        <input type="submit" name="submit" value="Submit">
        <button type="button"><a href="index.php?a=gridAction">Cancel</a></button></br>   
        </form>
        </div>
    </body>
</html>