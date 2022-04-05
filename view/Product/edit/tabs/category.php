<?php $product = $this->getProducts(); ?>
  <?php $categoryPath = $this->getCategoryWithPath(); //print_r($categoryPath);?>
  <?php $categories = $this->getCategories(); //print_r($categories); ?>
  <?php $categoryProductPair = $this->getCategoryProductPair(); //print_r($categoryProductPair);?>



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
                    <td width="10%">Categories</td>
                    <td>
                      <table border='1'>
                        <tr>
                          <th>Check Box</th>
                          <th>Category Id</th>
                          <th>Category Name</th>
                        </tr>

                        <?php foreach ($categories as $categoryProduct): ?>
                          <tr>
                            <td><input type="checkbox" name="category[]" value="<?php echo $categoryProduct->categoryId ?>"<?php if($categoryProductPair):
                            if(in_array($categoryProduct->categoryId, $categoryProductPair)): ?>
                              checked
                            <?php endif; ?>
                            <?php endif; ?>></td>
                            <td><?php echo $categoryProduct->categoryId ?></td>
                            <td>
                              <?php $result = $categoryPath; 
                              echo $result[$categoryProduct->categoryId];
                              ?>
                            </td>
                          </tr>
                        <?php endforeach; ?>
                      </table>
                    </td>
                  </tr>
                  <tr>
                    <td width="25%">&nbsp;</td>
                    <td>
                     <button class="btn btn-success" type="button" onclick="saveAndNext()">Save and Next</button>
                     <button class="btn btn-danger" type="button" onclick="cancelForm()">Cancel</button>
                   </td>
                 </tr> 

                 <br>
                 <br>
                 <br>
                 <br>



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
      admin.setUrl("<?php echo $this->getEdit()->getSaveUrl();?>");
    //alert(admin.getUrl());
    admin.load();
  }

  function cancelForm() 
  {
    admin.setUrl("<?php echo $this->getUrl('gridBlock') ?>");
    admin.load();
  }
</script>