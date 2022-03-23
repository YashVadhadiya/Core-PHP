<?php $cartItems = $this->getCartItem();  ?>
<?php $products = $this->getProducts(); ?>
<?php $order = $this->getOrder();?>

<h2>Products </h2>
<div id="addProduct" style = "display:none">
<form action="<?php echo $this->getUrl('addProduct','cart',null,false) ?>" method="POST">
        <button type="submit" name="Add"  >Add Selected Item</button>
        <button ><a href="<?php echo $this->getUrl('cartShow','cart',null,false) ?>">Cancel</a></button>
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
                                <img src="<?php echo 'Media/product/' . $product->baseImage; ?>" width="100px" height="100px" alt="image">
                                <?php endif;?></td>
                        <td><?php echo $product->name ?></td>
                        <td><input type="number" name="quantity[<?php echo $product->id ?>]" value="1" min="1" max="<?php echo $product->quantity; ?>"></td>
                        <td><?php echo $product->price ?></td>
                        <td colspan="2"><input type="checkbox" name="selected[]" value="<?php echo $product->id ?>"></td>
            <?php endforeach ?>
                        
            <?php else:?>
                <tr><td colspan='10'>No Record Available</td></tr>          
            <?php endif; ?>
        </table>
    </form>
</div>

<div id='details'>
<button type="submit" name="Add" id="toggle">New Item</button>
<button id="id1" onclick="showDiv()">Update</button>
<table border=1 width=100%>
    <tr>
        <th> Image </th>
        <th> Product Name </th>
        <th> Quantity </th>
        <th> Price </th>
        <th> Total </th>
        <th> Remove Product </th>
        
    </tr>
        
    <?php $total = 0; ?>
    <?php if($cartItems):?>
     <?php foreach ($cartItems as $cartItem): ?>
            <tr>
                <td><?php if(!$cartItem->baseImage): echo "No Image"; ?>
                        <?php else:?>
                        <img src="<?php echo 'Media/product/' . $cartItem->baseImage; ?>" width="100px" height="100px" alt="image">
                        <?php endif;?></td>
                <td><?php echo $cartItem->name ?></td>
                <td><?php echo $cartItem->quantity ?></td>
                <td><?php echo $cartItem->price ?></td>
                <td><?php echo $cartItem->price * $cartItem->quantity ?></td>
                <td>
                    <a href="<?php echo$this->getUrl('removeProduct','cart',['itemId' => $cartItem->itemId],false) ?>">Delete</a> 
                </td>
                </tr>
                    <?php $total = $total + ($cartItem->price * $cartItem->quantity); ?>
                    <?php endforeach; ?>
    <?php else:?>
        <tr><td colspan='10'>No Record Available</td></tr>          
    <?php endif; ?>

</table>

<?php if($order):
        $orderTotal = $order->grandTotal - ($order->taxAmount + $order->shippingAmount);
        else: $orderTotal = 0; endif; ?>

<?php if(!$total):
$total = 0;
        endif; ?>

<div id="add" style = "display:block;"> <input type="text" value="<?php echo $orderTotal; ?>" disabled></div>
<div id="add2" style = "display:none;"> <input type="text" value="<?php echo $total; ?>" disabled></div>

<script type="text/javascript">
    const targetDiv = document.getElementById("addProduct");
    const btn = document.getElementById("toggle");
    btn.onclick = function () 
    {
      if (targetDiv.style.display !== "none") 
      {
          targetDiv.style.display = "none";
      } 
      else 
      {
          targetDiv.style.display = "block";
      }
    };
    function showDiv() 
    {
        document.getElementById('add').style.display = "none";
        document.getElementById('add2').style.display = "block";
    };
</script>
