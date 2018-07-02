<?php require_once('includes/header.php'); ?>
    <div id="wrapper">
        <!-- Navigation -->
        <?php require_once('includes/nav.php'); ?>
        <div id="page-wrapper">
            <div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header">Product</h1>
                </div>                
            </div>           
            <div class="row">
                <div class="col-md-12">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            <?php                            
                            $connection  = $database->connect;
                            $customFunction = new customFunction();
                            $allData = mysqli_query($connection, "SELECT p.p_id, p.p_price, p.p_title, p.p_image, p.p_cond, p.p_available, p.p_model, p.is_active, c.cat_id, c.cat_name, s.sub_id, s.sub_name, brand.br_id, brand.br_name FROM product AS p LEFT JOIN category AS c ON c.cat_id = p.cat_id LEFT JOIN sub_cat AS s ON s.sub_id = p.sub_id LEFT JOIN brand ON brand.br_id = p.br_id ORDER BY p.p_id DESC ");
                            $num_rows = $customFunction->numRows($allData);
                            ?>
                            All Product (<?php echo $num_rows; ?>)
                        </div>
                        <!-- /.panel-heading -->
                        <div class="panel-body">
                            <div class="table-responsive">                            
                                <table class="table table-striped table-bordered table-hover">
                                    <thead>
                                        <tr>
                                            <th>#</th>                     
                                            <th>Title</th>
                                            <th>Price</th>
                                            <th>Image</th>
                                            <th>Brand</th>
                                            <th>Condition</th>        
                                            <th>Stock</th>
                                            <th>Model</th>
                                            <th>Category</th>
                                            <th>Sub Category</th>
                                            <th>Status</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>

    <?php
    $upload_folder = "../images/product/";
    while ( $productRow = mysqli_fetch_array($allData) ) {

        $p_id           = (int) $productRow['p_id'];
        $p_title        = $productRow['p_title'];
        $p_price        = $productRow['p_price'];
        $p_img          = $productRow['p_image'];
        $p_brand        = $productRow['br_name'];
        $p_cond         = $productRow['p_cond'];  
        if( $p_cond == 1 ) {
            $p_cond =  "New";
        } elseif( $p_cond == 2 ) {
            $p_cond = "Old";
        } elseif( $p_cond == 3 ) {
            $p_cond = "Used";
        }
        $p_stock        = $productRow['p_available'];
        if($p_stock == 1) {
            $p_stock = "In Stock";
        } elseif($p_stock == 0) {
            $p_stock = "Sold Out!";
        }
        $p_model        = $productRow['p_model'];
        $p_cat          = $productRow['cat_name'];
        $p_sub          = $productRow['sub_name'];
        $is_active      = $productRow['is_active'];        
        if( $is_active == 1) {
            $status = "<span class='label label-success'>Active</span>";
        } elseif( $is_active == 0 ) {
            $status = "<span class='label label-danger'>In-active</span>";
        }
        ?>
        <tr>
            <td><?php echo $p_id; ?></td>
            <td><?php echo $p_title; ?></td>
            <td><?php echo $p_price; ?></td>
            <td><?php echo "<img src='$upload_folder{$p_img}' class='img-responsive' width='50'>"; ?></td>
            <td><?php echo $p_brand; ?></td>
            <td><?php echo $p_cond; ?></td>            
            <td><?php echo $p_stock; ?></td>
            <td><?php echo $p_model; ?></td>
            <td><?php echo $p_cat; ?></td>
            <td><?php echo $p_sub; ?></td>
            <td><?php echo $status; ?></td>
            <td><?php echo "<a href='edit_product.php?p_id=$p_id'>Edit</a> | <a href='delete.php?p_id=$p_id&type=product'>Delete</a>"; ?></td>
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