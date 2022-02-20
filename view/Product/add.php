<?php $urlAction = new Controller_Core_Action();?>
<!DOCTYPE html>
<html>
<head>
	<title>Product Insert</title>
</head>

<body>
    <table border="1" width="100%">
        <form method="post" action="<?php echo $urlAction->getUrl('save','product',null,true) ?>">
            <tr>
                <td>Product Name</td>
                <td><input type="text" name="product[name]"></td>
            </tr>
            <tr>
                <td>Status</td>
                <td><select name="product[status]">
                    <option value="1">Active</option>
                    <option value="2">Inactive</option>
                </select>
            </td>
        </tr>
        <tr>
            <td>Price</td>
            <td><input type="text" name="product[price]"></td>
        </tr>
        <tr>
            <td>Quantity</td>
            <td><input type="text" name="product[quantity]"></td>
        </tr>
        <tr>
            <td>&nbsp;</td>
            <td><input type="submit" name="submit" value="Submit">
                <button type="button"><a href="<?php echo $urlAction->getUrl('grid','product',null,true) ?>">Cancel</a></button></td>
            </tr>
        </form>
    </table>
</body>
</html>