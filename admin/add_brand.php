<?php require_once('includes/header.php'); ?>
    <div id="wrapper">
        <!-- Navigation -->
        <?php require_once('includes/nav.php'); ?>
        <div id="page-wrapper">
            <div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header">Add a new brand</h1>
                </div>                
            </div>   

            <div class="row">
                <div class="col-md-6">
<?php
$customFunction = new customFunction();
$connection  = $database->connect;

if( isset($_POST['submit']) && $_POST['submit'] == 'Add New Brand' ) {    
    
    $br_name = $customFunction->inputvalid($_POST['br_name']);
    $errors = array();

    $query = mysqli_query($connection, "SELECT br_name FROM brand WHERE br_name = '$br_name' ");
    $num_row = mysqli_num_rows($query);

    if( isset($br_name)) {

        if( empty($br_name) ) {
            $errors[] = 'Enter your brand name';
        } elseif( strlen($br_name) < 2 || strlen($br_name) > 20 ) {
            $errors[] = 'Please enter brand name within 2-20 characters';
        } elseif( $num_row == 1 ) {
            $errors[] = 'Your brand name is already exist';
        }

        if(!empty($errors)) {
            echo "<div class='alert alert-danger'>";
            foreach ($errors as $error) {
                echo $error;
                echo '<br/>';
            }
            echo '</div>';
        } else {

            $column_name = array('br_name', 'is_active');
            $column_values = array($br_name, 1);
            $query = $customFunction->insert_data('brand', $column_name, $column_values);            

            if( $query ) {
                echo "<div class='alert alert-success'>New brand added</div>";
                $customFunction->redirect('all_brand.php', 3 );
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
                            <label>Brand Name</label>
                            <input type="text" name="br_name" class="form-control" value="<?php if(isset($_POST['br_name'])) echo $_POST['br_name'] ?>" placeholder="Brand Name" >
                        </div>
                        <div class="form-group">                            
                            <input type="submit" name="submit" value="Add New Brand" class="btn btn-success" >
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