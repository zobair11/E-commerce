<?php require_once('includes/header.php'); ?>
    <div id="wrapper">
        <!-- Navigation -->
        <?php require_once('includes/nav.php'); ?>
        <div id="page-wrapper">
            <div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header">Sub Category</h1>
                </div>                
            </div>           
            <div class="row">
                <div class="col-md-12">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            <?php                            
                            $connection  = $database->connect;
                            $customFunction = new customFunction();
                            $allData = $customFunction->getAllData('sub_cat', 'sub_id', 'DESC');

                            $allData = mysqli_query($connection, "SELECT sub.*, cat.cat_id, cat.cat_name FROM sub_cat AS sub LEFT JOIN category AS cat ON sub.cat_id = cat.cat_id ORDER BY sub.sub_id ");
                            $num_rows = $customFunction->numRows($allData);
                            ?>
                            All Sub Category (<?php echo $num_rows; ?>)
                        </div>
                        <!-- /.panel-heading -->
                        <div class="panel-body">
                            <div class="table-responsive">                            
                                <table class="table table-striped table-bordered table-hover">
                                    <thead>
                                        <tr>
                                            <th>#</th>                                
                                            <th>Sub Category Name</th>
                                            <th>Cat Id</th>
                                            <th>Cat Name</th>
                                            <th>Status</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>

                                    <?php  
                                    $x = 1;                               
                                    while ( $subRow = mysqli_fetch_array($allData) ) {

                                        $sub_id         = (int) $subRow['sub_id'];
                                        $cat_id         = (int) $subRow['cat_id'];
                                        $cat_name       = $subRow['cat_name'];
                                        $sub_name       = $subRow['sub_name'];      
                                        $is_active      = $subRow['is_active'];

                                        if( $is_active == 1) {
                                            $status = "<span class='label label-success'>Active</span>";
                                        } elseif( $is_active == 0 ) {
                                            $status = "<span class='label label-danger'>In-active</span>";
                                        }
                                        ?>
                                        <tr>
                                            <td><?php echo $x; ?></td>
                                            <td><?php echo $sub_name; ?></td> 
                                            <td><?php echo $cat_id; ?></td> 
                                            <td><?php echo $cat_name; ?></td>  
                                            <td><?php echo $status; ?></td>
                                            <td><?php echo "<a href='edit_sub_category.php?cat_id=$cat_id&sub_id=$sub_id'>Edit</a> | <a href='delete.php?type=subcategory&cat_id=$cat_id&sub_id=$sub_id'>Delete</a>"; ?></td>
                                        </tr> 
                                        <?php
                                        $x++;
                                    }
                                    ?>
                                        

                                    </tbody>
                                </table>
                            </div>
                            <!-- /.table-responsive -->
                        </div>
                     </div>   
                </div>               
            </div>           
        </div> 
    </div>
    <!-- /#wrapper -->
<?php 
require_once('includes/js.php');
require_once('includes/footer.php');
?>