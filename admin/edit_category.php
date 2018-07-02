<?php require_once('includes/header.php'); ?>
    <div id="wrapper">
        <!-- Navigation -->
        <?php require_once('includes/nav.php'); ?>
        <div id="page-wrapper">
            <div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header">Edit Category</h1>
                </div>                
            </div>   

            <div class="row">
                <div class="col-md-6">
<?php
$customFunction = new customFunction();
$connection  = $database->connect;

$cat_id = (int) $_GET['cat_id'];
$getCat_id = mysqli_query($connection, "SELECT cat_id FROM category WHERE cat_id = '$cat_id' ");
$num_row = mysqli_num_rows($getCat_id);
$getData = $customFunction->getAllData('category', 'cat_id', 'DESC', $cat_id);
$fetch = mysqli_fetch_array($getData);
$cat_name = $fetch['cat_name'];


if( $num_row > 0 ) {

    // validation start here
    if( isset($_POST['submit']) && $_POST['submit'] == 'Edit Category' ) {    
        
        $cat_name = $customFunction->inputvalid($_POST['cat_name']);
        $errors = array();

        $query = mysqli_query($connection, "SELECT cat_name FROM category WHERE cat_name = '$cat_name' AND cat_id != $cat_id ");        
        $num_row = mysqli_num_rows($query);

        if( isset($cat_name)) {

            if( empty($cat_name) ) {
                $errors[] = 'Enter your category name';
            } elseif( strlen($cat_name) < 2 || strlen($cat_name) > 20 ) {
                $errors[] = 'Please enter category name within 2-20 characters';
            } elseif( $num_row == 1 ) {
                $errors[] = 'Your category name is already exist';
            }

            if(!empty($errors)) {
                echo "<div class='alert alert-danger'>";
                foreach ($errors as $error) {
                    echo $error;
                    echo '<br/>';
                }
                echo '</div>';
            } else {

                $column_name = array('cat_name');
                $column_value = array($cat_name);

                $query = $customFunction->updateData('category', $column_name, $column_value, 'cat_id', $cat_id);          

                if( $query ) {
                    echo "<div class='alert alert-success'>Cateogry name updated</div>";
                    $customFunction->redirect('all_category.php', 3);
                } else {
                    echo "<div class='alert alert-danger'>Somethign went wrong.</div>";
                    echo mysqli_error($connection);
                }

            }
        }
    }
    // validattion end here
    ?>
    <form role="form" method="POST" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF'])."?cat_id=$cat_id"; ?>">
        <div class="form-group">
            <label>Category Name</label>
            <input type="text" name="cat_name" class="form-control" value="<?php if(isset($_POST['cat_name'])) echo $_POST['cat_name']; else echo $cat_name ; ?>" placeholder="Category Name" >
        </div>
        <div class="form-group">                            
            <input type="submit" name="submit" value="Edit Category" class="btn btn-success" >
        </div>
    </form>
    <?php
} else {
    echo "<div class='alert alert-danger'>Sorry, No Category name found.</div>";
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