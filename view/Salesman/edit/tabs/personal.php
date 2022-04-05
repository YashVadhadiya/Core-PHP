<?php $salesman = $this->getsalesman(); ?>

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
                                    <td>First Name</td>
                                    <td><input type="text" name="salesman[firstName]" value="<?php echo $salesman->firstName ?>"></td>
                                </tr>
                                <tr>
                                    <td>Last Name</td>
                                    <td><input type="text" name="salesman[lastName]" value="<?php echo $salesman->lastName ?>"></td>
                                </tr>
                                <tr>
                                    <td>Email</td>
                                    <td><input type="text" name="salesman[email]" value="<?php echo $salesman->email ?>"></td>
                                </tr>
                                <tr>
                                    <td>phone</td>
                                    <td><input type="text" name="salesman[phone]" value="<?php echo $salesman->phone ?>"></td>
                                </tr>
                                <tr>
                                    <td>Percentage</td>
                                    <td><input type="number" step="0.01" name="salesman[percentage]" value="<?php echo $salesman->percentage ?>"></td>
                                </tr>

                                <tr>
                                    <td>Status</td>
                                    <td>
                                        <select name="salesman[status]">
                                            <?php foreach ($salesman->getStatus() as $key => $value): ?>
                                                <option <?php if($salesman->status == $key): ?> selected <?php endif; ?> value="<?php echo $key; ?>"> <?php echo $value; ?></option>
                                            <?php endforeach; ?>
                                        </select>
                                    </td>
                                </tr>
                                <tr>
                                    <td>&nbsp;</td>
                                    <input type="hidden" name="salesman[salesmanId]" value="<?php echo $salesman->salesmanId ?>">
                                    <td>
                                        <button class="btn btn-success" type="button" onclick="saveAndNext()">Next</button>
                                        <button class="btn btn-primary" type="button" onclick="salesmanCancel()">Cancel</button>
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

    function salesmanCancel() 
    {
        admin.setUrl("<?php echo $this->getUrl('gridBlock') ?>");
        admin.load();
    }
</script>