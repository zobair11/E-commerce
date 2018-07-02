<?php require_once('includes/header.php'); ?>
    <div id="wrapper">
        <!-- Navigation -->
        <?php require_once('includes/nav.php'); ?>
        <div id="page-wrapper">
            <div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header">Add a new Banner</h1>
                </div>                
            </div>   

            <div class="row">
                <div class="col-md-6">
<?php
$customFunction = new customFunction();
$connection  = $database->connect;

if( isset($_POST['submit']) && $_POST['submit'] == 'Add New Banner' ) {    
    
    $b_title        = $customFunction->inputvalid($_POST['b_title']);
    $b_sub_title    = $customFunction->inputvalid($_POST['b_sub_title']);
    $b_des          = $customFunction->inputvalid($_POST['b_des']);    
    $b_button       = $customFunction->inputvalid($_POST['b_button']);
    $b_button_url   = $customFunction->inputvalid($_POST['b_button_url']);

    if( isset($_FILES['b_img']['name']) ) {

        $b_img_tmp      = $_FILES['b_img']['tmp_name'];
        $b_img_name     = $_FILES['b_img']['name'];
        $b_img_type     = $_FILES['b_img']['type'];
        $b_img_size     = $_FILES['b_img']['size'];

        $allowable      = array('jpg', 'png', 'jpeg', 'gif');
        $explode        = explode('.', $b_img_name);
        $b_img_ext      = @$explode[1];      
        $upload_folder  = '../images/banner/';

    }
    
    $errors = array();

    $query = mysqli_query($connection, "SELECT b_title FROM banner WHERE b_title = '$b_title' ");
    $num_row = mysqli_num_rows($query);

    if( isset($b_title, $b_sub_title, $b_des, $b_button, $b_button_url  )) {

        if( empty($b_title) ) {
            $errors[] = 'Enter your banner title';
        } elseif( strlen($b_title) < 2 || strlen($b_title) > 255 ) {
            $errors[] = 'Please enter banner title within 2-255 characters';
        } elseif( $num_row == 1 ) {
            $errors[] = 'Your banner name is already exist';
        }

        if( empty($b_sub_title) ) {
            $errors[] = 'Enter your banner sub title';
        } elseif( strlen($b_sub_title) < 2 || strlen($b_sub_title) > 255 ) {
            $errors[] = 'Please enter banner sub title within 2-255 characters';
        }

        if( empty($b_des) ) {
            $errors[] = 'Enter your banner description';
        } elseif( strlen($b_des) < 2 || strlen($b_des) > 1000 ) {
            $errors[] = 'Please enter banner description within 2-1000 characters';
        }

        if( empty($b_img_name) ) {
            $errors[] = 'Upload your banner image';
        } elseif( !in_array($b_img_ext, $allowable)  ) {
            $errors[] = 'We only accepting jpg, jpeg, png and gif format image';
        } elseif ( $b_img_size > 5000000 ) {
            $errors[] = 'Uploaded file size is too big';
        }

        if( empty($b_button) ) {
            $errors[] = 'Enter your banner button name';
        } elseif( strlen($b_button) < 2 || strlen($b_button) > 20 ) {
            $errors[] = 'Please enter banner button name within 2-20 characters';
        }

        if( empty($b_button_url) ) {
            $errors[] = 'Enter your banner button url';
        }

        if(!empty($errors)) {
            echo "<div class='alert alert-danger'>";
            foreach ($errors as $error) {
                echo $error;
                echo '<br/>';
            }
            echo '</div>';
        } else {

            $rand = uniqid();
            $b_img_new = $rand.'.'.$b_img_ext;

            $column_name = array('b_title', 'b_sub_title', 'b_des', 'b_img', 'b_button', 'b_button_url', 'is_active');
            $column_values = array($b_title, $b_sub_title, $b_des, $b_img_new, $b_button, $b_button_url, 1);
            $query = $customFunction->insert_data('banner', $column_name, $column_values);            

            if( $query ) {               
                if( move_uploaded_file($b_img_tmp, $upload_folder."$b_img_new")) {
                    echo "<div class='alert alert-success'>New banner added</div>";
                    $customFunction->redirect('all_banner.php', 3);
                } else {
                    echo "<div class='alert alert-danger'>File is not uploaded.</div>";
                    echo mysqli_error($connection); 
                }                    
            } else {
                echo "<div class='alert alert-danger'>Somethign went wrong.</div>";
                echo mysqli_error($connection);
            }
        }
    }
}
?>
                    <form role="form" method="POST" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" enctype="multipart/form-data">
                        <div class="form-group">
                            <label>Banner Title</label>
                            <input type="text" name="b_title" class="form-control" value="<?php if(isset($_POST['b_title'])) echo $_POST['b_title'] ?>" placeholder="Banner Title" >
                        </div>
                        <div class="form-group">
                            <label>Banner Sub Title</label>
                            <input type="text" name="b_sub_title" class="form-control" value="<?php if(isset($_POST['b_sub_title'])) echo $_POST['b_sub_title'] ?>" placeholder="Banner Sub Title" >
                        </div>
                        <div class="form-group">
                            <label>Banner Description</label>
                            <textarea name="b_des" class="form-control" cols="30" rows="5" placeholder="Banner Description"><?php if(isset($_POST['b_des'])) echo $_POST['b_des'] ?></textarea>
                        </div>
                        <div class="form-group">
                            <label>Upload Banner</label>
                            <input type="file" name="b_img">
                        </div>
                        <div class="form-group">
                            <label>Banner Button</label>
                            <input type="text" name="b_button" class="form-control" value="<?php if(isset($_POST['b_button'])) echo $_POST['b_button'] ?>" placeholder="Banner Button name" >
                        </div>
                        <div class="form-group">
                            <label>Banner Button URL</label>
                            <input type="text" name="b_button_url" class="form-control" value="<?php if(isset($_POST['b_button_url'])) echo $_POST['b_button_url'] ?>" placeholder="Banner Button URL" >
                        </div>
                        <div class="form-group">                            
                            <input type="submit" name="submit" value="Add New Banner" class="btn btn-success" >
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