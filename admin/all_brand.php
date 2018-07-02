<?php require_once('includes/header.php'); ?>
    <div id="wrapper">
        <!-- Navigation -->
        <?php require_once('includes/nav.php'); ?>
        <div id="page-wrapper">
            <div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header">Brand</h1>
                </div>                
            </div>           
            <div class="row">
                <div class="col-md-12">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            <?php                            
                            $connection  = $database->connect;
                            $customFunction = new customFunction();
                            $allData = $customFunction->getAllData('brand', 'br_id', 'DESC');
                            $num_rows = $customFunction->numRows($allData);
                            ?>
                            All Brand (<?php echo $num_rows; ?>)
                        </div>
                        <!-- /.panel-heading -->
                        <div class="panel-body">
                            <div class="table-responsive">                            
                                <table class="table table-striped table-bordered table-hover">
                                    <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>Brand Name</th>
                                            <th>Status</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>

                                    <?php
                                    while ( $brandRow = mysqli_fetch_array($allData) ) {
                                        $br_id         = (int) $brandRow['br_id'];
                                        $br_name    = $brandRow['br_name'];
                                        $is_active  = $brandRow['is_active'];

                                        if( $is_active == 1) {
                                            $status = "<span class='label label-success'>Active</span>";
                                        } elseif( $is_active == 0 ) {
                                            $status = "<span class='label label-danger'>In-active</span>";
                                        }
                                        ?>
                                        <tr>
                                            <td><?php echo $br_id; ?></td>
                                            <td><?php echo $br_name; ?></td>
                                            <td><?php echo $status; ?></td>
                                            <td><?php echo "<a href='edit_brand.php?br_id=$br_id'>Edit</a> | <a href='delete_brand.php?br_id=$br_id'>Delete</a>"; ?></td>
                                        </tr> 
                                        <?php
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