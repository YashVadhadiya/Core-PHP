<?php $product = $this->getProduct(); ?>
<?php $urlAction = new Controller_Core_Action();?>
<!DOCTYPE html>
<html>

<head>
    <title>Product Update</title>
</head>

<body>
    <table border="1" width="100%">
        <form action="<?php echo$urlAction->getUrl('save','product',['id' =>  $product->id],true) ?>" method="post">
            <tr>
                <td>Id</td>
                <td><input type="text" name="product[id]" value="<?php echo $product->id; ?>" readonly></td>
            </tr>
            <tr>
                <td>Name</td>
                <td><input type="text" name="product[name]" value="<?php echo $product->name; ?>"></td>
            </tr>
            <tr>
                <td>Price</td>
                <td><input type="text" name="product[price]" value="<?php echo $product->price; ?>"></td>
            </tr>
            <tr>
                <td>Quantity</td>
                <td><input type="text" name="product[quantity]" value="<?php echo $product->quantity; ?>"></td>
            </tr>
            <tr>
                <td>Status</td>
                <td><select name="product[status]">
                        <?php if($product->status == 2): ?>
                              <option value='2'>InActive</option>
                              <option value='1'>Active</option>
                            <?php else: ?>
                              <option value='1'>Active</option>
                              <option value='2'>InActive</option>
                            <?php endif;?>
                    </select></td>
            </tr>
            <tr>
                <td></td>
                <td><input type="submit" name="submit" value="Save">
                    <button type="button"><a href="<?php echo $urlAction->getUrl('grid','product',null,true) ?>">Cancel</a></button>
                </td>
            </tr>
        </form>
    </table>

            

</body>

</html>