<?php require_once('includes/header.php'); ?>
    <div id="wrapper">
        <!-- Navigation -->
        <?php require_once('includes/nav.php'); ?>
        <div id="page-wrapper">
            <div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header">Delete <?php echo ucfirst($_GET['type']); ?></h1>
                </div>                
            </div>           
            <div class="row">
                <div class="col-md-12">
<?php
$type =  $_GET['type'];

if( $type == 'category') {

    // delete category start here
    $cat_id = (int) $_GET['cat_id'];
    $customFunction = new CustomFunction();

    if( isset($_POST['delete']) && $_POST['delete'] == 'YES' ) { 

        $query = $customFunction->deleteData('category', 'cat_id', $cat_id);

        if( $query ) {
            echo "<div class='alert alert-success'>Category deleted</div>";
            $customFunction->redirect('all_category.php', 3);
        } else {
            echo "<div class='alert alert-danger'>Somethign went wrong.</div>";
            echo mysqli_error($connection);
        }

    } elseif( isset($_POST['delete']) && $_POST['delete'] == 'NO' ) {
        $customFunction->redirect('all_category.php');
    }
    ?>                  
                    <h3>Are you sure to delete this <?php echo $_GET['type']; ?>?</h3>
                    <form role="form" method="POST" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF'])."?type=$type&cat_id=$cat_id"; ?>">
                        <div class="form-group">                            
                            <input type="submit" name="delete" value="YES" class="btn btn-danger">
                            <input type="submit" name="delete" value="NO" class="btn btn-success">
                        </div>                       
                    </form>
                </div>               
            </div>           
        </div> 
    </div>
    <!-- /#wrapper -->


    <?php
    // delete category end here


} elseif( $type == 'subcategory') {
?>
<?php
    // delete sub category start here
    $cat_id = (int) $_GET['cat_id'];
    $sub_id = (int) $_GET['sub_id'];
    $customFunction = new CustomFunction();

    if( isset($_POST['delete']) && $_POST['delete'] == 'YES' ) { 

        $query = $customFunction->deleteData('sub_cat', 'sub_id', $sub_id);

        if( $query ) {
            echo "<div class='alert alert-success'>Sub Category deleted</div>";
            $customFunction->redirect('all_sub_category.php', 3);
        } else {
            echo "<div class='alert alert-danger'>Somethign went wrong.</div>";
            echo mysqli_error($connection);
        }

    } elseif( isset($_POST['delete']) && $_POST['delete'] == 'NO' ) {
        $customFunction->redirect('all_sub_category.php');
    }
    // delete sub category end here
?>
<h3>Are you sure to delete this <?php echo ucfirst($_GET['type']); ?>?</h3>
<form role="form" method="POST" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF'])."?type=$type&cat_id=$cat_id&sub_id=$sub_id"; ?>">
    <div class="form-group">                            
        <input type="submit" name="delete" value="YES" class="btn btn-danger">
        <input type="submit" name="delete" value="NO" class="btn btn-success">
    </div>                       
</form>

<?php
}

require_once('includes/js.php');
require_once('includes/footer.php');
?>