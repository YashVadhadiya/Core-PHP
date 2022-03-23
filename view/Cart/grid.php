<?php $carts = $this->getCarts(); ?>
<?php $perPageCount = $this->getPager()->getPerPageCount(); ?>

<script type="text/javascript">
    function url(ele)
    {
        var page = ele.value;
        var pageUrl = "<?php echo $this->getUrl('grid','cart',['p' => $this->getPager()->getStart()],false) ?>&ppr="+ele.value;
        window.open(pageUrl,"_self");
    }
</script>

<button name='Start'><a href="<?php echo $this->getUrl('grid','cart',['p' => $this->getPager()->getStart()]) ?>">Start</a></button>
    <?php if($this->getPager()->getPrev() == null):?>
<button name='Prev' disabled ><a>Previous</a></button>
    <?php else: ?>
<button name='Previous'><a href="<?php echo $this->getUrl('grid','cart',['p' => $this->getPager()->getPrev()]) ?>">Previous</a></button>
    <?php endif;?>

<select name="page" id="page" onchange="url(this)">
    <?php foreach ($this->getPager()->getPerPageCountOptions() as $perPage): ?>
        <?php if($perPageCount == $perPage): ?>
        <option selected='selected' value="<?php echo $perPage; ?>"> 
            <?php echo $perPage; ?> 
            </option>
        <?php else:?>
            <option value="<?php echo $perPage; ?>"> 
            <?php echo $perPage; ?> 
            </option>
        <?php endif; ?>
    <?php endforeach; ?>
</select>

<button name='Current'><a href="<?php echo $this->getUrl('grid','cart',['p' => $this->getPager()->getCurrent()]) ?>">Current</a></button>    
    <?php if($this->getPager()->getNext() == null):?>
<button name='next' disabled ><a>Next</a></button>
    <?php else: ?>
<button name='Next'><a href="<?php echo $this->getUrl('grid','cart',['p' => $this->getPager()->getNext()]) ?>">Next</a></button>
    <?php endif;?>
<button name='End'><a href="<?php echo $this->getUrl('grid','cart',['p' => $this->getPager()->getEnd()]) ?>">End</a></button>
<hr>
<form action="<?php echo $this->getUrl('add','cart',null,false) ?>" method="POST">
        <button type="submit" name="Add"><a href="<?php echo $this->getUrl('add','cart',['p' => $this->getPager()->getStart()]) ?>">Add To Customer's Cart</a></button>
</form>

<div id='details'>
<table border=1 width=100%>
    <tr>
        <th> Id </th>
        <th> Customer Id</th>
        <th> Total </th>
        <th> Shipping Method Id</th>
        <th> Payment Method Id</th>
        <th> Shipping Amount </th>
        <th> Created Date </th>
    </tr>
    <?php if($carts):
        foreach ($carts as $cart): ?>
            <tr>
                <td><?php echo $cart->cartId ?></td>
                <td><?php echo $cart->customerId ?></td>
                <td><?php echo $cart->total ?></td>
                <td><?php echo $cart->shippingMethodId ?></td>
                <td><?php echo $cart->paymentMethodId ?></td>
                <td><?php echo $cart->shippingAmount ?></td>
                <td><?php echo $cart->createdAt ?></td>
            </tr>
        <?php endforeach;?>
    <?php else:?>
        <tr><td colspan='10'>No Record Available</td></tr>          
    <?php endif; ?>
</table>