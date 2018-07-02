<?php require_once('includes/header.php'); ?>
    <div id="wrapper">
        <!-- Navigation -->
        <?php require_once('includes/nav.php'); ?>
        <div id="page-wrapper">
            <div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header">Add a new Sub subegory</h1>
                </div>                
            </div>   

            <div class="row">
                <div class="col-md-6">
<?php
$customFunction = new customFunction();
$connection  = $database->connect;

if( isset($_POST['submit']) && $_POST['submit'] == 'Add New Sub Category' ) {    
    
    $sub_name = $customFunction->inputvalid($_POST['sub_name']);
    $cat_id = $customFunction->inputvalid($_POST['cat_id']);
    $errors = array();

    $query = mysqli_query($connection, "SELECT sub_name FROM sub_cat WHERE sub_name = '$sub_name' ");
    $num_row = mysqli_num_rows($query);

    $check2 = mysqli_query($connection, "SELECT sub_name FROM sub_cat WHERE cat_id = '$cat_id' AND sub_name = '$sub_name' ");
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
            $column_values = array($sub_name, $cat_id, 1);
            $query = $customFunction->insert_data('sub_cat', $column_name, $column_values);            

            if( $query ) {
                echo "<div class='alert alert-success'>New subcategory added</div>";
                $customFunction->redirect('all_sub_category.php', 3);
            } else {
                echo "<div class='alert alert-danger'>Somethign went wrong.</div>";
                echo mysqli_error($connection);
            }
        }
    }
}
?>
                    <form role="form" method="POST" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>">
                        <div class="form-group">
                            <label>Category Name</label>
                            <select name="cat_id" class="form-control">
                            <option value="">--Select--</option>
                            <?php
                            $getCat = $customFunction->getAllData('category', 'cat_id');
                            while ( $fetch = mysqli_fetch_array($getCat) ) {
                                $cat_id     = (int) $fetch['cat_id'];
                                $cat_name   = $fetch['cat_name'];

                                echo "<option value='$cat_id'>$cat_name</option>";
                            }
                            ?>
                            </select>
                        </div>
                        <div class="form-group">
                            <label>subegory Name</label>
                            <input type="text" name="sub_name" class="form-control" value="<?php if(isset($_POST['sub_name'])) echo $_POST['sub_name'] ?>" placeholder="subegory Name" >
                        </div>
                        <div class="form-group">                            
                            <input type="submit" name="submit" value="Add New Sub Category" class="btn btn-success" >
                        </div>
                    </form>
                </div>               
            </div>           
        </div> 
    </div>
    <!-- /#wrapper -->
<?php 
require_once('includes/js.php');
require_once('includes/footer.php');
?>