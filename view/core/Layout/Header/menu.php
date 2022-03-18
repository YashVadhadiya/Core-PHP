<body>
    <!-- this is nav bar code -->
    <nav class="navbar navbar-expand-lg navbar-light bg-light"> <a class="navbar-brand" href="<?php echo $this->getUrl('grid','admin',null,true) ?>">Admin</a>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav">
                <li class="nav-item active">
                    <a class="nav-link" href="<?php echo $this->getUrl('grid','customer',null,true) ?>" name="customer">Customer</a>
                </li>
                <li class="nav-item active">
                    <a class="nav-link" href="<?php echo $this->getUrl('grid','category',null,true) ?>" name="category">Category</a>
                </li>
                <li class="nav-item active">
                    <a class="nav-link" href="<?php echo $this->getUrl('grid','product',null,true) ?>" name="Product">Product</a>
                </li>
                <li class="nav-item active">
                    <a class="nav-link" href="<?php echo $this->getUrl('grid','config',null,true) ?>" name="config">Config</a>
                </li>
                <li class="nav-item active">
                    <a class="nav-link" href="<?php echo $this->getUrl('grid','salesman',null,true) ?>" name="salesman">Salesman</a>
                </li>
                <li class="nav-item active">
                    <a class="nav-link" href="<?php echo $this->getUrl('grid','page',null,true) ?>" name="page">Page</a>
                </li>
                <li class="nav-item active">
                    <a class="nav-link" href="<?php echo $this->getUrl('grid','vendor',null,true) ?>" name="vendor">Vendor</a>
                </li>
                <li class="nav-item active">
                    <a class="nav-link" href="<?php echo $this->getUrl('logout','admin_login',null,true) ?>" name="logout">Logout</a>
                </li>
            </ul>
        </div>
    </nav>
    <!-- nav bar ends -->
</body>