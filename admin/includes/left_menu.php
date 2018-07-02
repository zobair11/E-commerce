<div class="navbar-default sidebar" role="navigation">
    <div class="sidebar-nav navbar-collapse">
        <ul class="nav" id="side-menu">
            <li class="sidebar-search">
                <div class="input-group custom-search-form">
                    <input type="text" class="form-control" placeholder="Search...">
                    <span class="input-group-btn">
                    <button class="btn btn-default" type="button">
                        <i class="fa fa-search"></i>
                    </button>
                </span>
                </div>
                <!-- /input-group -->
            </li>  
            <li>
                <a href=""><?php echo isset($_SESSION['admin_email']) ? 'Welcome ' . $_SESSION['admin_email'] : '' ?></a>
            </li>          
            <li>
                <a href="#"><i class="fa fa-bar-chart-o fa-fw"></i> Products<span class="fa arrow"></span></a>
                <ul class="nav nav-second-level">
                    <li>
                        <a href="add_product.php">Add Product</a>
                    </li>
                    <li>
                        <a href="all_product.php">All Product</a>
                    </li>
                </ul>
                <!-- /.nav-second-level -->
            </li>
            <li>
                <a href="#"><i class="fa fa-bar-chart-o fa-fw"></i> Users<span class="fa arrow"></span></a>
                <ul class="nav nav-second-level">
                    <li>
                        <a href="#">Add User</a>
                    </li>
                    <li>
                        <a href="#">All User</a>
                    </li>
                </ul>
                <!-- /.nav-second-level -->
            </li>             
            <li>
                <a href="#"><i class="fa fa-bar-chart-o fa-fw"></i> Category<span class="fa arrow"></span></a>
                <ul class="nav nav-second-level">
                    <li>
                        <a href="add_category.php">Add Category</a>
                    </li>
                    <li>
                        <a href="all_category.php">All Category</a>
                    </li>
                </ul>
                <!-- /.nav-second-level -->
            </li>  
            <li>
                <a href="#"><i class="fa fa-bar-chart-o fa-fw"></i> Sub Category<span class="fa arrow"></span></a>
                <ul class="nav nav-second-level">
                    <li>
                        <a href="add_sub_category.php">Add Sub Category</a>
                    </li>
                    <li>
                        <a href="all_sub_category.php">All Sub Category</a>
                    </li>
                </ul>
                <!-- /.nav-second-level -->
            </li>
            <li>
                <a href="#"><i class="fa fa-bar-chart-o fa-fw"></i> Brand<span class="fa arrow"></span></a>
                <ul class="nav nav-second-level">
                    <li>
                        <a href="add_brand.php">Add Brand</a>
                    </li>
                    <li>
                        <a href="all_brand.php">All Brand</a>
                    </li>
                </ul>
                <!-- /.nav-second-level -->
            </li>           
            <li>
                <a href="#"><i class="fa fa-bar-chart-o fa-fw"></i> Banner<span class="fa arrow"></span></a>
                <ul class="nav nav-second-level">
                    <li>
                        <a href="add_banner.php">Add Banner</a>
                    </li>
                    <li>
                        <a href="all_banner.php">All Banner</a>
                    </li>
                </ul>
                <!-- /.nav-second-level -->
            </li>
            <li>
                <a href="settings.php"><i class="fa fa-bar-chart-o fa-fw"></i> Settings</a>
            </li>        
        </ul>
    </div>
    <!-- /.sidebar-collapse -->
</div>