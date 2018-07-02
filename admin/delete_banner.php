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
<?php
$b_id = (int) $_GET['b_id'];
$customFunction = new CustomFunction();

if( isset($_POST['delete']) && $_POST['delete'] == 'YES' ) { 

    $query = $customFunction->deleteData('banner', 'b_id', $b_id);

    if( $query ) {
        echo "<div class='alert alert-success'>Banner deleted</div>";
        $customFunction->redirect('all_banner.php', 3);
    } else {
        echo "<div class='alert alert-danger'>Somethign went wrong.</div>";
        echo mysqli_error($connection);
    }

} elseif( isset($_POST['delete']) && $_POST['delete'] == 'NO' ) {
    $customFunction->redirect('all_banner.php');
}
?>                  
                    <h3>Are you sure to delete?</h3>
                   <form role="form" method="POST" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF'])."?b_id=$b_id"; ?>">
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
require_once('includes/js.php');
require_once('includes/footer.php');
?>