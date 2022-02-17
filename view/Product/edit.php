<?php $product = $this->getProduct(); ?>
<!DOCTYPE html>
<html>

<head>
    <title>Product Update</title>
</head>

<body>
    <table border="1" width="100%">
        <form action="index.php?c=product&a=save" method="post">
            <tr>
                <td>Id</td>
                <td><input type="text" name="product[id]" value="<?php echo $product['id']; ?>" readonly></td>
            </tr>
            <tr>
                <td>Name</td>
                <td><input type="text" name="product[name]" value="<?php echo $product['name']; ?>"></td>
            </tr>
            <tr>
                <td>Price</td>
                <td><input type="text" name="product[price]" value="<?php echo $product['price']; ?>"></td>
            </tr>
            <tr>
                <td>Quantity</td>
                <td><input type="text" name="product[quantity]" value="<?php echo $product['quantity']; ?>"></td>
            </tr>
            <tr>
                <td>Status</td>
                <td><select name="product[status]">
                        <option value="1" <?php if($product['status'] == 1): ?> selected = "selected" <?php endif; ?>>Active</option>
                        <option value="2" <?php if($product['status'] == 2): ?> selected = "selected" <?php endif; ?>>Inactive</option>
                    </select></td>
            </tr>
            <tr>
                <td></td>
                <td><input type="submit" name="submit" value="Save">
                    <button type="button"><a href="index.php?c=product&a=grid">Cancel</a></button>
                </td>
            </tr>
        </form>
    </table>

            

</body>

</html>