<?php $order = $this->getOrder(); ?>
<?php $customer = $this->getCustomer();?>
<?php $orderAddress = $this->getOrderAddress(); ?>
<?php $orderItems = $this->getOrderItems(); ?>
<?php $shippingMethod = $this->getShippingMethod();?>
<?php $paymentMethod = $this->getPaymentMethod(); ?>
<?php $billingAddress = $this->getBillingAddress();?>
<?php $shippingAddress = $this->getShippingAddress();?>
<?php $mediaModel = Ccc::getModel('Product_Media'); ?>
<?php $cartItems = $this->getCartItems(); ?>
<?php $cart = $this->getCart(); ?>
<?php $orderComment = $this->getOrderComment(); ?>
<div class="content-wrapper">
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="card">

                        <!-- /.card-header -->
                        <div class="card-body">
                            <h2>Customer Details <h2>
                                <table id="example2" class="table table-bordered table-hover">
                                    <tr>
                                        <th> Id </th>
                                        <th> First Name </th>
                                        <th> Last Name </th>
                                        
                                    </tr>
                                    <?php if($customer):?>
                                        <tr>
                                            <td><?php echo $customer->id ?></td>
                                            <td><?php echo $customer->firstName ?></td>
                                            <td><?php echo $customer->lastName ?></td>
                                            
                                        <?php else:?>
                                            <tr><td colspan='10'>No Record Available</td></tr>          
                                        <?php endif; ?>
                                    </table>
                                    <hr>
                                    <table id="example2" class="table table-bordered table-hover">
                                        <tr>
                                            <th colspan="2"><h2>Shipping Method</h2></th>
                                            <th><h2>Payment Method</h2></th>
                                        </tr>
                                        <tr>
                                            <td><?php echo $shippingMethod->name; ?></td>
                                            <td><?php echo "₹" ." ".$shippingMethod->price; ?></td>
                                            <td><?php echo $paymentMethod->name; ?></td>
                                        </tr>

                                    </table>

                                    <hr>
                                    <table id="example2" class="table table-bordered table-hover">
                                        <tr>
                                            <th><h2>Billing Details</h2></th>
                                            <th><h2>Shipping Details</h2></th>
                                        </tr>
                                        <tr>
                                            <td>
                                                <?php echo $billingAddress->firstName ." ". $billingAddress->lastName?>
                                                <br><?php echo $billingAddress->address ?>
                                                <br><?php echo $billingAddress->city ."-". $billingAddress->postalCode ?>
                                                <br><?php echo $billingAddress->state ?>
                                                <br><?php echo $billingAddress->country ?>
                                                <br><?php echo $billingAddress->phone ?>
                                            </td>
                                            <td>
                                                <?php echo $shippingAddress->firstName ." ". $shippingAddress->lastName?>
                                                <br><?php echo $shippingAddress->address ?>
                                                <br><?php echo $shippingAddress->city ."-". $shippingAddress->postalCode ?>
                                                <br><?php echo $shippingAddress->state ?>
                                                <br><?php echo $shippingAddress->country ?>
                                                <br><?php echo $shippingAddress->phone ?>
                                            </td>
                                        </tr>

                                    </table>
                                    <hr>

                                    <table id="example2" class="table table-bordered table-hover">
                                        <tr>
                                            <th><h2>Product Details</h2></th>
                                        </tr>
                                        <?php foreach ($orderItems as $orderItem): ?>
                                            <tr>
                                                <td>
                                                    <?php if(!$orderItem->image): echo "No Image." ?>
                                                    <?php else: ?>
                                                        <img src="<?php echo $mediaModel->getImageUrl() . $orderItem->image; ?>" width="75px" height="75px">
                                                    <?php endif;?>
                                                </td>
                                                <td>
                                                    <?php echo $orderItem->name;?><br>
                                                    <?php echo "₹" ." ".$orderItem->price;?><br>
                                                    <?php echo "Quantity: " .$orderItem->quantity;?><br>
                                                </td>
                                            </tr>
                                        <?php endforeach; ?>
                                    </table>
                                    <hr>

                                    <?php $totalDiscount = 0; ?>
                                    <?php foreach ($cartItems as $cartItem)
                                    {
                                        $totalDiscount = $totalDiscount + $cartItem->discount * $cartItem->quantity;
                                    } 
                                    ?>
                                    <h2>Order Details</h2>
                                    <table id="example2" class="table table-bordered table-hover">
                                        <?php if(!$cartItems):?>
                                            <tr>
                                                <th>Sub Total</th>
                                                <td>0</td>
                                            </tr>
                                            <tr>
                                                <th>Shipping Amount</th>
                                                <td>0</td>
                                            </tr>
                                            <tr>
                                                <th>Tax</th>
                                                <td>0</td>
                                            </tr>
                                            <tr>
                                                <th>Discount</th>
                                                <td>0</td>
                                            </tr>
                                            <tr>
                                                <th>Grand Total</th>
                                                <td>0</td>
                                            </tr>
                                        <?php else:?>
                                            <tr>
                                                <th>Sub Total</th>
                                                <td>
                                                    <?php $total = 0;?>
                                                    <?php foreach ($cartItems as $cartItem) 
                                                    {
                                                        $priceTotal = $cartItem->quantity * $cartItem->price;
                                                        $total = $priceTotal + $total;
                                                    }
                                                    ?>
                                                    <?php echo $total. " ₹";?>
                                                </td>
                                            </tr>
                                            <tr>
                                                <th>Shipping Amount</th>
                                                <td>
                                                    <?php echo "+" ." ".$cart->shippingAmount. " ₹"?>
                                                </td>
                                            </tr>
                                            <tr>
                                                <th>Tax</th>
                                                <td>
                                                    <?php $taxTotal = 0;?>
                                                    <?php foreach ($cartItems as $cartItem) 
                                                    {
                                                        $taxTotal = $taxTotal + $cartItem->taxAmount;
                                                    }
                                                    ?>
                                                    <?php echo "+ " ." ".$taxTotal. " ₹";?>
                                                </td>
                                            </tr>
                                            <tr>
                                                <th>Discount</th>
                                                <td><?php echo "-" ." ".$totalDiscount." ₹" ?></td>
                                            </tr>
                                            <tr>
                                                <th>Grand Total</th>
                                                <td>
                                                    <?php echo "= " ." ".($total + $cart->shippingAmount + $taxTotal - $totalDiscount). " ₹"; ?>
                                                </td>
                                            </tr>
                                        <?php endif; ?>
                                        <tr>
                                            <td colspan="4">
                                                <h1>Order Details</h1>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>Id</td>
                                            <td>
                                                <input type="text" name="orderComment[orderId]" value="<?php echo $orderComment->orderId; ?>" readonly>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>note</td>
                                            <td><input type="text" name="orderComment[note]" value="<?php echo $orderComment->note ; ?>" ></td>
                                        </tr>

                                        <tr>
                                            <td>Status</td>
                                            <td><select name="orderComment[status]">
                                                <?php foreach ($orderComment->getStatus() as $key => $value): ?>
                                                    <option <?php if($orderComment->status == $key): ?> selected <?php endif; ?> value="<?php echo $key; ?>"> <?php echo $value; ?></option>
                                                <?php endforeach; ?>
                                            </select></td>
                                        </tr>
                                        <tr>
                                            <td>Notify Comment</td>
                                            <td><input type="checkbox" name="orderComment[checkBox]" value="<?php echo $orderComment->commentId ?>"<?php echo ($orderComment->customerNotified==1) ? 'checked' : '' ; ?>></td>
                                        </tr>

                                        <tr>
                                            <td>&nbsp;</td>
                                            <td><button class="btn btn-success" onclick="saveComment()" type="button" value="save">Save</button> </td>
                                        </tr>
                                    </table>
                                    <hr>
                                    <button class="btn btn-primary" type="button" onclick="orderCancel()">Back To Orders</button>
                                    <hr>
                                </div>
                                <!-- /.card-body -->
                            </div>
                            <!-- /.card -->
                        </div>
                        <!-- /.col -->
                    </div>
                    <!-- /.row -->
                </div>
                <!-- /.container-fluid -->
            </section>
        </div>
        <script type="text/javascript">

            function saveComment() 
            {
                admin.setForm(jQuery('#indexForm'));
                admin.setUrl("<?php echo $this->getUrl('orderComment','order',null,false) ?>");
                //alert(admin.getUrl());
                admin.load();  
            }

            function orderCancel() 
            {
                admin.setUrl("<?php echo $this->getUrl('gridBlock') ?>");
                admin.load();
            }
        </script>