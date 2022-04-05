<head>
    <!-- Google Font: Source Sans Pro -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="skin/admin/css/all.min.css">
    <!-- overlayScrollbars -->
    <link rel="stylesheet" href="skin/admin/css/OverlayScrollbars.min.css">
    <!-- Theme style -->
    <link rel="stylesheet" href="skin/admin/css/admin.css">
</head>
<body class="hold-transition sidebar-mini layout-fixed">
    <!-- Site wrapper -->
    <div class="wrapper">
        <!-- Navbar -->
        <!-- Main Sidebar Container -->
        <aside class="main-sidebar sidebar-light-primary elevation-4">
            <!-- Brand Logo -->

            <!-- Sidebar -->
            <div class="sidebar">
                <!-- Sidebar user (optional) -->
                <div class="user-panel mt-3 pb-3 mb-3 d-flex">
                    <img src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcSsyA44JdhHChP6kGqx36BolQq4Hn7z2yGekw&usqp=CAU" style="border-radius: 50%;">
                    <div class="info">
                        <a href="<?php echo $this->getUrl('index','admin',null,true) ?>" class="d-block">Admin User</a>
                    </div>
                </div>

                <!-- SidebarSearch Form -->
                <div class="form-inline">
                    <div class="input-group" data-widget="sidebar-search">
                        <input class="form-control form-control-sidebar" type="search" placeholder="Search" aria-label="Search">   
                    </div>
                </div>

                <!-- Sidebar Menu -->
                <nav class="mt-2">
                    <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
<!-- Add icons to the links using the .nav-icon class
    with font-awesome or any other icon font library -->

    <li class="nav-item">
        <a href="<?php echo $this->getUrl('index','admin',null,true) ?>" class="nav-link">

            <p>Admin</p>
        </a>
    </li>

    <li class="nav-item">
        <a href="<?php echo $this->getUrl('index','customer',null,true) ?>" class="nav-link">

            <p>Customer</p>
        </a>
    </li>

    <li class="nav-item">
        <a href="<?php echo $this->getUrl('index','product',null,true) ?>" class="nav-link">

            <p>Product</p>
        </a>
    </li>

    <li class="nav-item">
        <a href="<?php echo $this->getUrl('index','category',null,true) ?>" class="nav-link">

            <p>Category</p>
        </a>
    </li>

    <li class="nav-item">
        <a href="<?php echo $this->getUrl('index','config',null,true) ?>" class="nav-link">

            <p>Config</p>
        </a>
    </li>

    <li class="nav-item">
        <a href="<?php echo $this->getUrl('index','salesman',null,true) ?>" class="nav-link">

            <p>Salesman</p>
        </a>
    </li>

    <li class="nav-item">
        <a href="<?php echo $this->getUrl('index','page',null,true) ?>" class="nav-link">

            <p>Page</p>
        </a>
    </li>

    <li class="nav-item">
        <a href="<?php echo $this->getUrl('index','vendor',null,true) ?>" class="nav-link">

            <p>Vendor</p>
        </a>
    </li>

    <li class="nav-item">
        <a href="<?php echo $this->getUrl('index','paymentMethod',null,true) ?>" class="nav-link">

            <p>Payment Method</p>
        </a>
    </li>

    <li class="nav-item">
        <a href="<?php echo $this->getUrl('index','shippingMethod',null,true) ?>" class="nav-link">

            <p>Shipping Method</p>
        </a>
    </li>

    <li class="nav-item">
        <a href="<?php echo $this->getUrl('index','order',null,true) ?>" class="nav-link">

            <p>Order</p>
        </a>
    </li>

    <li class="nav-item">
        <a href="<?php echo $this->getUrl('logout','admin_login',null,true) ?>" class="nav-link">

            <p>Logout</p>
        </a>
    </li>
</ul>
</nav>
<!-- /.sidebar-menu -->
</div>
<!-- /.sidebar -->
</aside>
</div>
<!-- ./wrapper -->

<!-- jQuery -->
<script src="skin/admin/js/jquery.min.js"></script>
<!-- Bootstrap 4 -->
<script src="skin/admin/js/bootstrap.bundle.min.js"></script>
<!-- overlayScrollbars -->
<script src="skin/admin/js/jquery.overlayScrollbars.min.js"></script>
<!-- AdminLTE App -->
<script src="skin/admin/js/adminlte.min.js"></script>
<!-- AdminLTE for demo purposes -->
<script src="skin/admin/js/demo.js"></script>
</body>
