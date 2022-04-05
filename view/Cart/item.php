<?php $cartItems = $this->getCartItem(); ?>
<?php $products = $this->getProducts(); ?>
<?php $mediaModel = Ccc::getModel('Product_Media')?>
<?php $order = $this->getOrder();?>

<h2>Item List</h2>
<div id="myDIV" style = "display:none">
    <button class="btn btn-success" type="button" name="Add" onclick="addSelectedroduct()" >Add Products In Cart</button>
    <button class="btn btn-warning"type="button" onclick="cancelForm()">Cancel</button>
    <table border=1 width=100%>
        <tr>
            <th> Image </th>
            <th> Product Name </th>
            <th> Quantity </th>
            <th> Price </th>
            <th> Action </th>
        </tr>

        <?php if($products):?>
           <?php foreach ($products as $product): ?>
            <tr>
                <td><?php if(!$product->baseImage): echo "No Image"; ?>
            <?php else:?>
                <img src="<?php echo $mediaModel->getImageUrl() . $product->baseImage; ?>" width="100px" height="100px" alt="image">
                <?php endif;?></td>
                <td><?php echo $product->name ?></td>
                <td><input type="number" name="quantity[<?php echo $product->id ?>]"  min="1" max="<?php echo $product->quantity; ?>" value="1"></td>
                <td><?php echo $product->price ?></td>
                <td colspan="2"><input type="checkbox" name="selected[]" value="<?php echo $product->id ?>"></td>
            <?php endforeach ?>
        <?php else:?>
            <tr><td colspan='10'>No Record Available</td></tr>          
        <?php endif; ?>
    </table>
</div>
<div id='info'>
    <button type="button" name="Add" class="Registerbtn btn btn-success" onclick="myFunction()"  id="toggle">Add New Products</button>
    <button class="btn btn-success" type="button" onclick="updateProduct()">Update</button>
    <table border=1 width=100%>
        <tr>
            <th> Image </th>
            <th> Product Name </th>
            <th> Quantity </th>
            <th> Price </th>
            <th> Total </th>
            <th> Action </th>
        </tr>

        <?php if($cartItems):?>
            <?php $total = 0 ?>
            <?php foreach ($cartItems as $cartItem): ?>
                <tr>
                    <td><?php if(!$cartItem->baseImage): echo "No Image"; ?>
                <?php else:?>
                    <img src="<?php echo $mediaModel->getImageUrl() . $cartItem->baseImage; ?>" width="100px" height="100px" alt="image">
                    <?php endif;?></td>
                    <td><?php echo $cartItem->name ?></td>
                    <td><input type="number" name="quan[<?php echo $cartItem->itemId ?>]"  min="1" max="10" value="<?php echo $cartItem->quantity ?>"></td>
                    <td><?php echo $cartItem->price ?></td>
                    <td><?php echo $cartItem->price * $cartItem->quantity ?></td>
                    <td>
                        <button type="button" value="<?php echo $cartItem->itemId;?>" class="btn btn-danger deleteProduct">Delete</button>
                    </td>
                </tr>
                <?php $total = $total + ($cartItem->price * $cartItem->quantity); ?>
            <?php endforeach ?>

            <td> <?php if(!$cartItems):
            $total = 0;
            endif; ?></td>
            <td></td>
            <td><input type="text" value="<?php echo $total; ?>" disabled></td>

        <?php else:?>
            <tr><td colspan='10'>No Record Available</td></tr>          
        <?php endif; ?>
    </table>
    

    <script type="text/javascript">
        function myFunction() {
          var x = document.getElementById("myDIV");
          if (x.style.display === "none") {
            x.style.display = "block";
        } else {
            x.style.display = "none";
        }
    }

    function addSelectedroduct() 
    {
            //alert('button clicked');
            admin.setForm(jQuery('#indexForm'));
            admin.setUrl("<?php echo $this->getUrl('addProduct','cart',null,false) ?>");
            admin.load();
        }

        function updateProduct() 
        {
            //alert('button clicked');
            admin.setForm(jQuery('#indexForm'));
            admin.setUrl("<?php echo $this->getUrl('updateItem','cart',null,false) ?>");
            //alert(admin.getUrl());
            admin.load();
        }

        function cancelForm() 
        {
            admin.setUrl("<?php echo $this->getUrl('cartShow','cart',null,false) ?>");
            admin.load();
        }

        $('.deleteProduct').click(function()
        {
            var data = $(this).val();
            //alert(data);
            admin.setForm(jQuery('#indexForm'));
            admin.setUrl("<?php echo$this->getUrl('removeProduct','cart',null,true) ?>&itemId="+data);
            //alert(admin.getUrl());
            admin.load();
        })
    </script>