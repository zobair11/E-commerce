<?php require_once('includes/header.php'); ?>
    <div id="wrapper">
        <!-- Navigation -->
        <?php require_once('includes/nav.php'); ?>
        <div id="page-wrapper">
            <div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header">Edit Sub subegory</h1>
                </div>                
            </div>   

            <div class="row">
                <div class="col-md-6">
<?php
$customFunction = new customFunction();
$connection  = $database->connect;

//get data from URL
$sub_id = (int) $_GET['sub_id'];
$cat_id = (int) $_GET['cat_id'];

$allData = mysqli_query($connection, "SELECT sub.*, cat.* FROM sub_cat AS sub LEFT JOIN category AS cat ON sub.cat_id = cat.cat_id WHERE sub.sub_id = $sub_id AND cat.cat_id = $cat_id ORDER BY sub.sub_id ");

$num_rows   = mysqli_num_rows($allData);
$fetch      = mysqli_fetch_array($allData);
$sub_name   = $fetch['sub_name'];
$status     = $fetch['is_active'];

if( $num_rows > 0 ) {

    // if get data is valid...
    if( isset($_POST['submit']) && $_POST['submit'] == 'Edit Sub Category' ) {    
    
        $sub_name = $customFunction->inputvalid($_POST['sub_name']);
        $cat_id = $customFunction->inputvalid($_POST['cat_id']);
        $status = $customFunction->inputvalid($_POST['status']);
        $errors = array();

        $query = mysqli_query($connection, "SELECT sub_name FROM sub_cat WHERE sub_name = '$sub_name' AND sub_id != '$sub_id' ");
        $num_row = mysqli_num_rows($query);

        $check2 = mysqli_query($connection, "SELECT sub_name FROM sub_cat WHERE cat_id = '$cat_id' AND sub_name = '$sub_name' AND sub_id != '$sub_id' ");
        $num_row2 = mysqli_num_rows($check2);

        if( isset($sub_name)) {

            if( empty($cat_id) ) {
                $errors[] = 'Select cateegory name';
            }
            
            if( empty($sub_name) ) {
                $errors[] = 'Enter your sub cateegory name';
            } elseif( strlen($sub_name) < 2 || strlen($sub_name) > 20 ) {
                $errors[] = 'Please enter subcateegory name within 2-20 characters';
            } elseif( $num_row == 1 ) {
                $errors[] = 'Your subcategory name is already exist';
            }

            

            if( $num_row2 == 1) {
                $error[] = 'Sub category already added under your select category';
            }

            if(!empty($errors)) {
                echo "<div class='alert alert-danger'>";
                foreach ($errors as $error) {
                    echo $error;
                    echo '<br/>';
                }
                echo '</div>';
            } else {

                $column_name = array('sub_name', 'cat_id', 'is_active');
                $column_value = array($sub_name, $cat_id, $status);

                $query = $customFunction->updateData('sub_cat', $column_name, $column_value, 'sub_id', $sub_id);          
            

                if( $query ) {
                    echo "<div class='alert alert-success'>Suh 
                    category updated</div>";
                    $customFunction->redirect('all_sub_category.php', 3);
                } else {
                    echo "<div class='alert alert-danger'>Somethign went wrong.</div>";
                    echo mysqli_error($connection);
                }
            }
        }
    }

    ?>
    <form role="form" method="POST" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF'])."?cat_id=$cat_id&sub_id=$sub_id"; ?>">
        <div class="form-group">
            <label>Category Name</label>
            <select name="cat_id" class="form-control">
            <option value="">--Select--</option>
            <?php
            $getCat = $customFunction->getAllData('category', 'cat_id');
            while ( $fetch = mysqli_fetch_array($getCat) ) {
                $cat_id_d     = (int) $fetch['cat_id'];
                $cat_name   = $fetch['cat_name'];
                if( $cat_id == $cat_id_d) {
                    $selected = 'selected = "selected" ';
                } else {
                    $selected = '';
                }
                echo "<option value='$cat_id_d' $selected>$cat_name</option>";
            }
            ?>
            </select>
        </div>
        <div class="form-group">
            <label>subegory Name</label>
            <input type="text" name="sub_name" class="form-control" value="<?php if(isset($_POST['sub_name'])) echo $_POST['sub_name']; else echo $sub_name; ?>" placeholder="subegory Name" >
        </div>
        <div class="form-group">
            <label>Status</label>
            <select name="status" class="form-control">
                <option value=""></option>
                <option value="1" <?php if($status == 1 ) echo 'selected = "selected"'; ?>>Active</option>
                <option value="0" <?php if($status == 0 ) echo 'selected = "selected"'; ?>>In-Active</option>
            </select>
        </div>
        <div class="form-group">                            
            <input type="submit" name="submit" value="Edit Sub Category" class="btn btn-success" >
        </div>
    </form>

    <?php

    // if get data is valid end here...
} else {
    echo "<div class='alert alert-danger'>No sub category found.</div>";
}


?>
                    
                </div>               
            </div>           
        </div> 
    </div>
    <!-- /#wrapper -->
<?php 
require_once('includes/js.php');
require_once('includes/footer.php');
?>