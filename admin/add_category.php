<?php require_once('includes/header.php'); ?>
    <div id="wrapper">
        <!-- Navigation -->
        <?php require_once('includes/nav.php'); ?>
        <div id="page-wrapper">
            <div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header">Add a new Category</h1>
                </div>                
            </div>   

            <div class="row">
                <div class="col-md-6">
<?php
$customFunction = new customFunction();
$connection  = $database->connect;

if( isset($_POST['submit']) && $_POST['submit'] == 'Add New Category' ) {    
    
    $cat_name = $customFunction->inputvalid($_POST['cat_name']);
    $errors = array();

    $query = mysqli_query($connection, "SELECT cat_name FROM category WHERE cat_name = '$cat_name' ");
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

            $column_name = array('cat_name', 'is_active');
            $column_values = array($cat_name, 1);
            $query = $customFunction->insert_data('category', $column_name, $column_values);            

            if( $query ) {
                echo "<div class='alert alert-success'>New category added</div>";
                $customFunction->redirect('all_category.php', 3);
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
                            <input type="text" name="cat_name" class="form-control" value="<?php if(isset($_POST['cat_name'])) echo $_POST['cat_name'] ?>" placeholder="Category Name" >
                        </div>
                        <div class="form-group">                            
                            <input type="submit" name="submit" value="Add New Category" class="btn btn-success" >
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