<?php $product = $this->getProduct(); ?>
<?php $urlAction = new Controller_Core_Action();?>

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
                        <?php foreach ($product->getStatus() as $key => $value): ?>
                        <option <?php if($product->status == $key): ?> selected <?php endif; ?> value="<?php echo $key; ?>"> <?php echo $value; ?></option>
                            <?php endforeach; ?>
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