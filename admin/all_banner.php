<?php require_once('includes/header.php'); ?>
    <div id="wrapper">
        <!-- Navigation -->
        <?php require_once('includes/nav.php'); ?>
        <div id="page-wrapper">
            <div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header">Banner</h1>
                </div>                
            </div>           
            <div class="row">
                <div class="col-md-12">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            <?php                            
                            $connection  = $database->connect;
                            $customFunction = new customFunction();
                            $allData = $customFunction->getAllData('banner', 'b_id', 'DESC');
                            $num_rows = $customFunction->numRows($allData);
                            ?>
                            All Banner (<?php echo $num_rows; ?>)
                        </div>
                        <!-- /.panel-heading -->
                        <div class="panel-body">
                            <div class="table-responsive">                            
                                <table class="table table-striped table-bordered table-hover">
                                    <thead>
                                        <tr>
                                            <th>#</th>                                  
                                            <th>Banner Title</th>
                                            <th>Banner Sub Title</th>
                                            <th>Banner Description</th>
                                            <th>Banner Image</th>
                                            <th>Banner Button</th>
                                            <th>Banner Button URL</th>
                                            <th>Status</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>

                                    <?php
                                    $upload_folder = "../images/banner/";
                                    while ( $bannerRow = mysqli_fetch_array($allData) ) {

                                        $b_id           = (int) $bannerRow['b_id'];
                                        $b_title        = $bannerRow['b_title'];
                                        $b_sub_title    = $bannerRow['b_sub_title'];
                                        $b_des          = $bannerRow['b_des'];
                                        $b_img          = $bannerRow['b_img'];
                                        $b_button       = $bannerRow['b_button'];
                                        $b_button_url   = $bannerRow['b_button_url'];
                                        $is_active      = $bannerRow['is_active'];

                                        if( $is_active == 1) {
                                            $status = "<span class='label label-success'>Active</span>";
                                        } elseif( $is_active == 0 ) {
                                            $status = "<span class='label label-danger'>In-active</span>";
                                        }
                                        ?>
                                        <tr>
                                            <td><?php echo $b_id; ?></td>
                                            <td><?php echo $b_title; ?></td>
                                            <td><?php echo $b_sub_title; ?></td>
                                            <td><?php echo $customFunction->readMore($b_des, 0, 20, "edit_banner.php?b_id=$b_id"); ?></td>
                                            <td><?php echo "<img src='$upload_folder{$b_img}' class='img-responsive' width='50'>"; ?></td>
                                            <td><?php echo $b_button; ?></td>
                                            <td><?php echo $b_button_url; ?></td>
                                            <td><?php echo $status; ?></td>
                                            <td><?php echo "<a href='edit_banner.php?b_id=$b_id'>Edit</a> | <a href='delete_banner.php?b_id=$b_id'>Delete</a>"; ?></td>
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