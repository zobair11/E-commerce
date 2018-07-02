<?php require_once('includes/header.php'); ?>
    <div id="wrapper">
        <!-- Navigation -->
        <?php require_once('includes/nav.php'); ?>
        <div id="page-wrapper">
            <div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header">Edit Banner</h1>
                </div>                
            </div>   

            <div class="row">
                <div class="col-md-6">
<?php
$customFunction = new customFunction();
$connection  = $database->connect;

$b_id = (int) $_GET['b_id'];
$check = mysqli_query($connection, "SELECT b_id FROM banner WHERE b_id = '$b_id' ");
$num_row = mysqli_num_rows($check);

//get existing data
$allData = $customFunction->getAllData('banner', 'b_id', '', $b_id);
$fetchAllData = mysqli_fetch_array($allData);

$b_title_d       = $customFunction->inputvalid($fetchAllData['b_title']);
$b_sub_title_d   = $customFunction->inputvalid($fetchAllData['b_sub_title']);
$b_des_d         = $customFunction->inputvalid($fetchAllData['b_des']);    
$b_button_d      = $customFunction->inputvalid($fetchAllData['b_button']);
$b_button_url_d  = $customFunction->inputvalid($fetchAllData['b_button_url']);
$b_img_d         = $customFunction->inputvalid($fetchAllData['b_img']);
$is_active       = $customFunction->inputvalid($fetchAllData['is_active']);
// end existing data

if($num_row > 0) {
    // validation start here...
    if( isset($_POST['submit']) && $_POST['submit'] == 'Edit New Banner' ) {    
        
        $b_title        = $customFunction->inputvalid($_POST['b_title']);
        $b_sub_title    = $customFunction->inputvalid($_POST['b_sub_title']);
        $b_des          = $customFunction->inputvalid($_POST['b_des']);    
        $b_button       = $customFunction->inputvalid($_POST['b_button']);
        $b_button_url   = $customFunction->inputvalid($_POST['b_button_url']);
        $is_active      = $customFunction->inputvalid($_POST['is_active']);

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

        $query = mysqli_query($connection, "SELECT b_title FROM banner WHERE b_title = '$b_title' AND b_id != $b_id ");
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

            if( !empty($b_img_name) ) {
                if( !in_array($b_img_ext, $allowable)  ) {
                    $errors[] = 'We only accepting jpg, jpeg, png and gif format image';
                } elseif ( $b_img_size > 5000000 ) {
                    $errors[] = 'Uploaded file size is too big';
                } 
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

                $column_name = array('b_title', 'b_sub_title', 'b_des', 'b_button', 'b_button_url', 'is_active');

                if(!empty($b_img_name)) {
                    array_push($column_name, 'b_img');
                }

                $column_value = array($b_title, $b_sub_title, $b_des, $b_button, $b_button_url, $is_active);

                if(!empty($b_img_name)) {
                    array_push($column_value, $b_img_new);
                }
                
                $query = $customFunction->updateData('banner', $column_name, $column_value, 'b_id', $b_id);             

                if( $query ) {    

                    if(!empty($b_img_name)) {
                       if( move_uploaded_file($b_img_tmp, $upload_folder."$b_img_new")) {
                            echo "<div class='alert alert-success'>Banner updated</div>";
                            // delete file
                            unlink("../images/banner/$b_img_d");
                            $customFunction->redirect('all_banner.php', 3);
                        } else {
                            echo "<div class='alert alert-danger'>File is not uploaded.</div>";
                            echo mysqli_error($connection); 
                        }   
                    } else {
                        echo "<div class='alert alert-success'>Banner updated</div>";
                        $customFunction->redirect('all_banner.php', 3);
                    }                              
                                      
                } else {
                    echo "<div class='alert alert-danger'>Somethign went wrong.</div>";
                    echo mysqli_error($connection);
                }
            }
        }
    }

    ?>
    <form role="form" method="POST" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF'])."?b_id=$b_id"; ?>" enctype="multipart/form-data">
        <div class="form-group">
            <label>Banner Title</label>
            <input type="text" name="b_title" class="form-control" value="<?php if(isset($_POST['b_title'])) echo $_POST['b_title']; else echo $b_title_d; ?>" placeholder="Banner Title" >
        </div>
        <div class="form-group">
            <label>Banner Sub Title</label>
            <input type="text" name="b_sub_title" class="form-control" value="<?php if(isset($_POST['b_sub_title'])) echo $_POST['b_sub_title']; else echo $b_sub_title_d; ?>" placeholder="Banner Sub Title" >
        </div>
        <div class="form-group">
            <label>Banner Description</label>
            <textarea name="b_des" class="form-control" cols="30" rows="5" placeholder="Banner Description"><?php if(isset($_POST['b_des'])) echo $_POST['b_des']; else echo $b_des_d; ?></textarea>
        </div>
        <div class="form-group">
            <label>Banner Image</label>
            <img src="<?php echo "../images/banner/".$b_img_d; ?>" alt="" class="img-responsive" width="50">
        </div>
        <div class="form-group">
            <label>Change Banner</label>
            <input type="file" name="b_img">
        </div>
        <div class="form-group">
            <label>Banner Button</label>
            <input type="text" name="b_button" class="form-control" value="<?php if(isset($_POST['b_button'])) echo $_POST['b_button']; else echo $b_button_d; ?>" placeholder="Banner Button name" >
        </div>
        <div class="form-group">
            <label>Banner Button URL</label>
            <input type="text" name="b_button_url" class="form-control" value="<?php if(isset($_POST['b_button_url'])) echo $_POST['b_button_url']; else echo $b_button_url_d; ?>" placeholder="Banner Button URL" >
        </div>
        <div class="form-group">
            <label>Status</label>
            <select name="is_active" class="form-control">
                <option value="">--Select Status</option>
                <option value="1" <?php if($is_active == 1 ) echo 'selected = "selected" '; ?>>Active</option>
                <option value="0" <?php if($is_active == 0 ) echo 'selected = "selected" '; ?>>In-Active</option>
            </select>
        </div>
        <div class="form-group">                            
            <input type="submit" name="submit" value="Edit New Banner" class="btn btn-success" >
        </div>
    </form>
    <?php
    /// validation end here
} else {
    echo "<div class='alert alert-danger'>Banner is not found.</div>";
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