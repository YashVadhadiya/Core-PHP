<?php $orders = $this->getOrders(); ?>
<?php $perPageCount = $this->getPager()->getPerPageCount(); ?>

<script type="text/javascript">
    function url(ele)
    {
        var page = ele.value;
        var pageUrl = "<?php echo $this->getUrl('grid','order',['p' => $this->getPager()->getStart()],false) ?>&ppr="+ele.value;
        window.open(pageUrl,"_self");
    }
</script>

<button name='Start'><a href="<?php echo $this->getUrl('grid','order',['p' => $this->getPager()->getStart()]) ?>">Start</a></button>
    <?php if($this->getPager()->getPrev() == null):?>
<button name='Prev' disabled ><a>Previous</a></button>
    <?php else: ?>
<button name='Previous'><a href="<?php echo $this->getUrl('grid','order',['p' => $this->getPager()->getPrev()]) ?>">Previous</a></button>
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

<button name='Current'><a href="<?php echo $this->getUrl('grid','order',['p' => $this->getPager()->getCurrent()]) ?>">Current</a></button>    
    <?php if($this->getPager()->getNext() == null):?>
<button name='next' disabled ><a>Next</a></button>
    <?php else: ?>
<button name='Next'><a href="<?php echo $this->getUrl('grid','order',['p' => $this->getPager()->getNext()]) ?>">Next</a></button>
    <?php endif;?>
<button name='End'><a href="<?php echo $this->getUrl('grid','order',['p' => $this->getPager()->getEnd()]) ?>">End</a></button>
        <table border="1" width="100%" cellspacing="4">
            <tr>
                <th>Id</th>
                <th>Customer Id</th>
                <th>Fist Name</th>
                <th>Last Name</th>
                <th>Email</th>
                <th>Phone</th>
                <th>Grand Total</th>
                <th>Tax Amount</th>
                <th>Shipping Method Id</th>
                <th>Shipping Ammount</th>
                <th>Payment Method Id</th>
                <th>State</th>
                <th>Status</th>
                <th>Created Date</th>
                <th>Updated Date</th>
                <th>Edit</th>
            </tr>
            <?php if(!$orders): ?>
                <tr>
                    <td colspan="17">No Record available.</td>
                </tr>
            <?php else : ?>
                <?php foreach ($orders as $order): ?>
                <tr>
                    <td><?php echo $order->orderId;?></td>
                    <td><?php echo $order->customerId; ?></td>
                    <td><?php echo $order->firstName; ?></td>
                    <td><?php echo $order->lastName; ?></td>
                    <td><?php echo $order->email; ?></td>
                    <td><?php echo $order->phone; ?></td>
                    <td><?php echo $order->grandTotal; ?></td>
                    <td><?php echo $order->taxAmount; ?></td>
                    <td><?php echo $order->shippingMethodId; ?></td>
                    <td><?php echo $order->shippingAmount; ?></td>
                    <td><?php echo $order->paymentMethodId; ?></td>
                    <td><?php echo $order->getState($order->state); ?></td>
                    <td><?php echo $order->getStatus($order->status); ?></td>
                    <td><?php echo $order->createdAt;?></td>
                    <td><?php echo $order->updatedAt;?></td>
                    <td><a href="<?php echo $this->getUrl('edit','order',['id'=> $order->orderId],false) ?>">Edit</a></td>
                </tr>
                <?php endforeach;   ?>
        <?php endif;  ?>
        </table>
