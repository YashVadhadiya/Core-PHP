<?php $medias = $this->getMedias(); ?>  
<?php $mediaModel = Ccc::getModel('Product_Media')?>


<div class="content-wrapper">
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="card">

                        <!-- /.card-header -->
                        <div class="card-body">
                            <table id="example2" class="table table-bordered table-hover">


                                <button class="btn btn-success" type="button" onclick="mediaUpdate()" name="update">Update</button>
                            </form>
                            <button class="btn btn-warning" ><a href="<?php echo $this->getUrl('index','product',null,true) ?>">Cancel</a></button>

                            <table border=1 width=100%>
                                <tr>
                                    <th>Image Id</th>
                                    <th>Image</th>
                                    <th>Base</th>
                                    <th>Thumb</th>
                                    <th>Small</th>
                                    <th>Gallary</th>
                                    <th>Status</th>
                                    <th>Remove</th>
                                </tr>
                                <?php if($medias): ?>

                                    <?php foreach ($medias as $media): ?>   
                                        <tr>
                                            <td><?php echo $media->imageId ; ?></td>
                                            <td><img src="<?php echo $mediaModel->getImageUrl() . $media->image; ?>" width="100px" height="100px" alt="image"></td>
                                            <td><input type="radio" name="media[base]" value="<?php echo $media->imageId?>"<?php echo ($media->base==1) ? 'checked' : '' ; ?>></td>
                                            <td><input type="radio" name="media[thumb]" value="<?php echo $media->imageId?>"<?php echo ($media->thumb==1) ? 'checked' : '' ;?>></td>
                                            <td><input type="radio" name="media[small]" value="<?php echo $media->imageId?>"<?php echo ($media->small==1) ? 'checked' : '' ;?>></td>
                                            <td><input type="checkbox" name="media[gallery][]" value="<?php echo $media->imageId ?>"<?php echo ($media->gallery==1) ? 'checked' : '' ; ?>></td>
                                            <td><input type="checkbox" name="media[status][]" value="<?php echo $media->imageId ?>"<?php echo ($media->status==1) ? 'checked' : '' ; ?>></td>
                                            <td><input type="checkbox" name="media[remove][]" value="<?php echo $media->imageId ?>"></td> 

                                        </tr>
                                    <?php endforeach; ?>
                                <?php else: ?>
                                    <tr><td colspan='8'>No Record Available</td></tr>
                                <?php endif; ?>

                            </table>
                            <br>
                            <br>
                            <br>
                            <br>
                            <form align="center" id="imageUploadForm" action="<?php echo $this->getUrl('add','product_media',null,false) ?>" method="POST" enctype="multipart/form-data">
                                <input type="file"  id="ImageBrowse" name="image[]" accept="image/*">
                                <input type="submit" name="upload" value="Upload">



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
<script>
    function mediaUpdate() 
    {
        admin.setForm(jQuery('#indexForm'));
        admin.setUrl("<?php echo $this->getUrl('save','product_media',null,false) ?>");
        //alert(admin.getForm());
        admin.load();
    }


    $(document).ready(function (e) {
        $('#imageUploadForm').on('submit',(function(e) {
            e.preventDefault();
            var formData = new FormData(this);

            $.ajax({
                type:'POST',
                url: $(this).attr('action'),
                data:formData,
                cache:false,
                contentType: false,
                processData: false,
                success:function(data){
                    urlFun();
                },
                error: function(data){
                    console.log("error");
                    console.log(data);
                }
            });

            function urlFun() {
                admin.setUrl("<?php echo $this->getUrl('gridBlock','product_media',null,false) ?>");
                //alert(admin.getUrl());
                admin.load();
            }
        }));   
    });
</script>