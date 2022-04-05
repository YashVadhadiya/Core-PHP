<?php $product = $this->getProducts(); ?>
<div class="content-wrapper">
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="card">

                        <!-- /.card-header -->
                        <div class="card-body">
                            <table id="example2" class="table table-bordered table-hover">
                                <tr>
                                    <td>Id</td>
                                    <td><input type="text" name="product[id]" value="<?php echo $product->id; ?>" readonly></td>
                                </tr>
                                <tr>
                                    <td>Name</td>
                                    <td><input type="text" name="product[name]" value="<?php echo $product->name; ?>"></td>
                                </tr>            
                                <tr>
                                    <td>Cost</td>
                                    <td><input type="text" name="product[cost]" value="<?php echo $product->cost; ?>"></td>
                                </tr>
                                <tr>
                                    <td>Price</td>
                                    <td><input type="text" name="product[price]" value="<?php echo $product->price; ?>"></td>
                                </tr>
                                <td>Discount Mode</td>
                                <td>
                                    <select name="product[discountMode]">
                                        <?php foreach ($product->getDiscountMode() as $key => $value): ?>
                                            <option <?php if($product->discountMode == $key): ?> selected <?php endif; ?> value="<?php echo $key; ?>"> <?php echo $value; ?></option>
                                        <?php endforeach; ?>
                                    </select>
                                </td>
                            </tr>
                        </tr>
                        <td>Discount</td>
                        <td><input type="text" name="product[discount]" value="<?php echo $product->discount; ?>"></td>
                        <tr>
                            <td>Tax</td>
                            <td><input type="number" name="product[tax]" value="<?php echo $product->tax; ?>"></td>
                        </tr>
                        <tr>
                            <td>Quantity</td>
                            <td><input type="text" name="product[quantity]" value="<?php echo $product->quantity; ?>"></td>
                        </tr>
                        <tr>
                            <td>SKU</td>
                            <td><input type="text" name="product[sku]" value="<?php echo $product->sku; ?>"></td>
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
                            <td>
                                <button class="btn btn-success" type="button" onclick="saveAndNext()">Save & Next</button>
                                <button class="btn btn-primary" type="button" onclick="productCancel()">Cancel</button>
                            </td>
                        </tr>
                    </table>

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

    function saveAndNext() 
    {
        admin.setForm(jQuery('#indexForm'));
        admin.setUrl("<?php echo $this->getEdit()->getSaveUrl(); ?>");
        //alert(admin.getUrl());
        admin.load();
    }

    function productCancel() 
    {
        admin.setUrl("<?php echo $this->getUrl('gridBlock') ?>");
        admin.load();
    }
</script>

