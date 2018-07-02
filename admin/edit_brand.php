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

$br_id = (int) $_GET['br_id'];
$getBr_id = mysqli_query($connection, "SELECT br_id FROM brand WHERE br_id = '$br_id' ");
$num_row = mysqli_num_rows($getBr_id);
$getData = $customFunction->getAllData('brand', 'br_id', 'DESC', $br_id);
$fetch = mysqli_fetch_array($getData);
$br_name = $fetch['br_name'];


if( $num_row > 0 ) {

    // validation start here
    if( isset($_POST['submit']) && $_POST['submit'] == 'Edit Brand' ) {    
        
        $br_name = $customFunction->inputvalid($_POST['br_name']);
        $errors = array();

        $query = mysqli_query($connection, "SELECT br_name FROM brand WHERE br_name = '$br_name' AND br_id != $br_id ");        
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

                $column_name = array('br_name');
                $column_value = array($br_name);

                $query = $customFunction->updateData('brand', $column_name, $column_value, 'br_id', $br_id);          

                if( $query ) {
                    echo "<div class='alert alert-success'>Brand name updated</div>";
                    $customFunction->redirect('all_brand.php', 3);
                } else {
                    echo "<div class='alert alert-danger'>Somethign went wrong.</div>";
                    echo mysqli_error($connection);
                }

            }
        }
    }
    // validattion end here
    ?>
    <form role="form" method="POST" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF'])."?br_id=$br_id"; ?>">
        <div class="form-group">
            <label>Brand Name</label>
            <input type="text" name="br_name" class="form-control" value="<?php if(isset($_POST['br_name'])) echo $_POST['br_name']; else echo $br_name; ?>" placeholder="Brand Name" >
        </div>
        <div class="form-group">                            
            <input type="submit" name="submit" value="Edit Brand" class="btn btn-success" >
        </div>
    </form>
    <?php
} else {
    echo "<div class='alert alert-danger'>Sorry, No brand name found.</div>";
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