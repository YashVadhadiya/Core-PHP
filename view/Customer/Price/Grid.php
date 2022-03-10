<?php 
$productsWithPercentage = $this->getProducts();
$products = $productsWithPercentage['products'];
$percentage = $productsWithPercentage['percentage'];
$prices = $this->getPrices();
?>
<?php $urlAction = new Controller_Core_Action();?>

<table border="1" width="100%" cellspacing="4">
    <tr>
        <th>Product ID</th>
        <th>Name</th>
        <th>Sku</th>
        <th>Price</th>
        <th>Salesman Price</th>
        <th>Customer Price</th>
    </tr>
    <form action="<?php echo $urlAction->getUrl('save','customer_price'); ?>" method="POST">
        <?php 
            
            if(!$products):
                echo '<tr><td colspan="6">No Records available</td></tr>';
            else:
                foreach($products as $product):
                    ?>
                    <tr>
                        <td><?php echo $product->id; ?></td>
                        <td><?php echo $product->name; ?></td>
                        <td><?php echo $product->sku; ?></td>
                        <td><?php echo $product->price; ?></td>
                        <td><?php echo $discountPrice = $product->price - ($product->price * $percentage) / 100; ?></td>
                        <td>
                            <input type="number" name="<?php if($prices): if(array_key_exists($product->id, $prices)):?> price[exists][<?php echo $product->id; ?>] <?php else: ?> price[new][<?php echo $product->id; ?>] <?php endif; endif;?> price[new] [<?php echo $product->id; ?>] ?>" step="0.01" min="<?php echo $discountPrice; ?>" max="<?php echo $product->price; ?>" value="<?php echo $prices[$product->id]; ?>" required>
                        </td>
                    </tr>
                <?php endforeach;
            endif;
        ?>
        <tr>
            <td colspan="6">
                <input type="submit" name="save" value="Save">
                <a href="<?php echo $this->redirect($this->getUrl('grid','salesman_customer',['id'=>Ccc::getFront()->getRequest()->getRequest('id')],true)); ?>">Cancel</a>
            </td>
        </tr>
    </form>
</table>