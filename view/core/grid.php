<div class="content-wrapper">
    <!-- Content Header (Page header) -->

    <?php 
    $collection = $this->getCollections();
    $actions = $this->getActions();
    $columns = $this->getColumns();
    $tableId = array_key_first($columns);
    $controller = Ccc::getFront()->getRequest()->getRequest('c');
    ?>
    <?php $perPageCount = $this->getPager()->getPerPageCount(); ?>
    <button class="btn btn-outline-success btn-lg" type="button" onclick="newRowAdd()">Add New</button>

    <h1> <?php echo ucfirst($controller);?> Details</h1> 


    <!-- Main content -->

    <section class="content">
      <div class="container-fluid">
        <div class="row">
          <div class="col-12">
            <div class="card">

              <!-- /.card-header -->
              <div class="card-body">
                <table id="example2" class="table table-bordered table-hover">
                    <tr>
                        <?php foreach($columns as $column): ?>
                            <th><?php echo $column['title']?></th>
                        <?php endforeach; ?>
                        <th>Action</th>

                    </tr>
                    <?php if($collection): ?>
                        <?php foreach ($collection as $row): ?>
                            <tr>
                                <?php foreach($columns as $key => $column):?>
                                    <td>
                                        <?php if($key == 'baseImage' || $key == 'smallImage' || $key == 'thumbImage'): ?>
                                            <img src="<?php echo $this->getColumnValue($row, $key, $column);?>" width="100px" height="100px" alt=" No Image Selected">
                                        <?php else:?>
                                            <?php echo $this->getColumnValue($row, $key, $column); ?></td>
                                        <?php endif ;?>
                                    </td>
                                <?php endforeach; ?> 
                                <td>
                                    <?php foreach($actions as $action): ?>

                                        <?php $method = $action['method'];?>
                                        <?php if($action['title'] == 'Delete'):?>
                                            <button  type="button" value="<?php echo $row->$tableId;?>" class="btn btn-outline-danger <?php echo $action['title'];?>"><?php echo $action['title']; ?></button>
                                        <?php else:?>
                                         <button  type="button" value="<?php echo $row->$tableId;?>" class="btn btn-outline-primary <?php echo $action['title'];?>"><?php echo $action['title']; ?></button>
                                     <?php endif;?>

                                 <?php endforeach; ?>
                             </td>
                         </tr>
                     <?php endforeach;?>
                 <?php else:?>
                    <tr><td colspan='10'>No Record Available</td></tr>          
                <?php endif; ?>
            </table>
            <div align="center">
                <?php if($this->getPager()->getPrev() == null):?>
                <button class="btn btn-primary" name='Start' disabled ><a>Start</a></button>
            <?php else: ?>
                <button class="btn btn-primary" type="button" onclick="startBtn()" name='Start'>Start</button>
            <?php endif;?>

            <?php if($this->getPager()->getPrev() == null):?>
            <button class="btn btn-primary"  name='Prev' disabled ><a>Previous</a></button>
        <?php else: ?>
            <button class="btn btn-primary" type="button" onclick="prvBtn()" name='Previous'>Previous</button>
        <?php endif;?>
        <select name="page" id="page" onchange="url(this)" class="btn btn-light btn-lg">
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
    <?php if($this->getPager()->getNext() == null):?>
    <button class="btn btn-primary" name='next' disabled ><a>Next</a></button>
<?php else: ?>
    <button class="btn btn-primary" type="button" onclick="nextBtn()" name='Next'>Next</button>
<?php endif;?>

<?php if($this->getPager()->getNext() == null):?>
<button class="btn btn-primary" name='End' disabled ><a>End</a></button>
<?php else: ?>
    <button class="btn btn-primary" type="button" onclick="endBtn()" name='End'>End</button>
<?php endif;?>
</div>
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

<!-- /.content -->
</div>
<script type="text/javascript">
    function url(ele) 
    {
        var page = ele.value;
        admin.setUrl("<?php echo $this->getUrl('gridBlock',null,['p' => $this->getPager()->getStart()],true) ?>&ppr="+ele.value);
        admin.load(); 
    }
</script>
<script type="text/javascript">

    function newRowAdd() 
    {
        admin.setUrl("<?php echo $this->getUrl('addBlock',null,['id' => null],true); ?>");
        //alert(admin.getUrl());
        admin.load();
    }

    $('.delete').click(function()
    {
        var data = $(this).val();
        admin.setUrl("<?php echo $this->getUrl('delete')?>&id="+data);
        //alert(admin.getUrl());
        admin.load();
    })

    $('.edit').click(function()
    {
        var data = $(this).val();
        admin.setUrl("<?php echo $this->getUrl('editBlock')?>&id="+data);
        //alert(admin.getUrl());
        admin.load();
    })

    $('.ViewOrder').click(function()
    {
        var data = $(this).val();
        admin.setUrl("<?php echo $this->getUrl('view')?>&id="+data);
        //alert(admin.getUrl());
        admin.load();
    })

    function startBtn() 
    {
        admin.setUrl("<?php echo $this->getUrl('gridBlock',null,['p' => $this->getPager()->getStart()]) ?>");
        admin.load();
    }

    function nextBtn() 
    {
        admin.setUrl("<?php echo $this->getUrl('gridBlock',null,['p' => $this->getPager()->getNext()]) ?>");
        admin.load();
    }

    function prvBtn() 
    {
        admin.setUrl("<?php echo $this->getUrl('gridBlock',null,['p' => $this->getPager()->getPrev()]) ?>");
        admin.load();
    }

    function endBtn() 
    {
        admin.setUrl("<?php echo $this->getUrl('gridBlock',null,['p' => $this->getPager()->getEnd()]) ?>");
        admin.load();
    }
</script>


<head>
  <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="skin/admin/css/all.min.css">
  <!-- DataTables -->
  <link rel="stylesheet" href="skin/admin/css/dataTables.bootstrap4.min.css">
  <link rel="stylesheet" href="skin/admin/css/responsive.bootstrap4.min.css">
  <link rel="stylesheet" href="skin/admin/css/buttons.bootstrap4.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="skin/admin/dist/css/adminlte.min.css">
</head>
<body class="hold-transition sidebar-mini">

  <!-- Main Sidebar Container -->

  <!-- Content Wrapper. Contains page content -->
  
  <!-- /.content-wrapper -->

<!-- ./wrapper -->

<!-- jQuery -->
<script src="skin/admin/js/jquery.min.js"></script>
<!-- Bootstrap 4 -->
<script src="skin/admin/js/bootstrap.bundle.min.js"></script>
<!-- DataTables  & Plugins -->
<script src="skin/admin/js/jquery.dataTables.min.js"></script>
<script src="skin/admin/js/dataTables.bootstrap4.min.js"></script>
<script src="skin/admin/js/dataTables.responsive.min.js"></script>
<script src="skin/admin/js/responsive.bootstrap4.min.js"></script>
<script src="skin/admin/js/dataTables.buttons.min.js"></script>
<script src="skin/admin/js/buttons.bootstrap4.min.js"></script>
<script src="skin/admin/js/jszip.min.js"></script>
<script src="skin/admin/js/pdfmake.min.js"></script>
<script src="skin/admin/js/vfs_fonts.js"></script>
<script src="skin/admin/js/buttons.html5.min.js"></script>
<script src="skin/admin/js/buttons.print.min.js"></script>
<script src="skin/admin/js/buttons.colVis.min.js"></script>
<!-- AdminLTE App -->
<script src="skin/admin/js/adminlte.min.js"></script>
<!-- AdminLTE for demo purposes -->
<script src="skin/admin/js/demo.js"></script>
<!-- Page specific script -->
<script>
  $(function () {
    $("#example1").DataTable({
      "responsive": true, "lengthChange": false, "autoWidth": false,
      "buttons": ["copy", "csv", "excel", "pdf", "print", "colvis"]
  }).buttons().container().appendTo('#example1_wrapper .col-md-6:eq(0)');
    $('#example2').DataTable({
      "paging": true,
      "lengthChange": false,
      "searching": false,
      "ordering": true,
      "info": true,
      "autoWidth": false,
      "responsive": true,
  });
});
</script>
</body>