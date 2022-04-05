<?php $customers = $this->getCustomers(); ?>
<div class="content-wrapper">
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="card">

                        <!-- /.card-header -->
                        <div class="card-body">
                            <table id="example2" class="table table-bordered table-hover">

                               <td>Customer List</td>
                               <td>
                                <select name="customerId" onchange="url(this)">
                                    <option>Select Customer</option>
                                    <?php foreach ($customers as $customer):?>
                                        <option value="<?php echo $customer->id ?>">
                                           <?php echo $customer->id . " - " . $customer->firstName; ?>
                                       </option>
                                   <?php endforeach; ?>            
                               </select>
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
    function url(ele) 
    {
        var page = ele.value;
        //alert(page);
        //var pageUrl = "<?php// echo $this->getUrl('cartCheck','cart',null,true) ?>&id="+ele.value;
        //window.open(pageUrl,"_self"); 
        admin.setForm(jQuery('#indexForm'));
        admin.setUrl("<?php echo $this->getUrl('cartCheck','cart',null,true) ?>&id="+ele.value);
        //alert(admin.getUrl());
        admin.load();  
    }
</script>

