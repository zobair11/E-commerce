<?php require_once('includes/header.php'); ?>
    <div id="wrapper">
        <!-- Navigation -->
        <?php require_once('includes/nav.php'); ?>
        <div id="page-wrapper">
            <div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header">Settings</h1>
                </div>                
            </div>           
            <div class="row">
                <div class="col-md-12">
<?php

$customFunction = new customFunction();
$connection  = $database->connect;
$getData    = $customFunction->getAllData('admin', '1');
$row        = mysqli_fetch_array($getData);
$logo       = $row['logo'];
$fb         = $row['fb'];
$tw         = $row['tw'];
$ins        = $row['ins'];
$gp         = $row['gp'];
$ph         = $row['phone'];
$contact    = $row['contact'];
$copy       = $row['copyright'];
$logo_img_d = $row['logo'];

// validation start here
if( isset($_POST['submit']) && $_POST['submit'] == 'Change Settings' ) {    
    
    if( isset($_FILES['logo']['name']) ) {

        $logo_tmp      = $_FILES['logo']['tmp_name'];
        $logo_name     = $_FILES['logo']['name'];
        $logo_type     = $_FILES['logo']['type'];
        $logo_size     = $_FILES['logo']['size'];

        $allowable      = array('jpg', 'png', 'jpeg', 'gif');
        $explode        = explode('.', $logo_name);
        $logo_ext      = @$explode[1];      
        $upload_folder  = '../images/logo/';
    }

    $fb         = $customFunction->inputvalid($_POST['fb']);
    $tw         = $customFunction->inputvalid($_POST['tw']);
    $ins        = $customFunction->inputvalid($_POST['ins']);
    $gp         = $customFunction->inputvalid($_POST['gp']);
    $ph         = $customFunction->inputvalid($_POST['ph']);
    $contact    = $customFunction->inputvalid($_POST['contact']);
    $copy       = $customFunction->inputvalid($_POST['copyright']);   

    if( isset($fb, $tw, $ins, $gp, $ph, $contact, $copy)) {

        if( !empty($logo_name) ) {
            if( !in_array($logo_ext, $allowable)  ) {
                $errors[] = 'We only accepting jpg, jpeg, png and gif format image';
            } elseif ( $logo_size > 5000000 ) {
                $errors[] = 'Uploaded file size is too big';
            } 
        }

        if( empty($fb) ) {
            $errors[] = 'Enter your facebook url';
        }

        if( empty($tw) ) {
            $errors[] = 'Enter your twitter url';
        }

        if( empty($ins) ) {
            $errors[] = 'Enter your instagram url';
        }

        if( empty($gp) ) {
            $errors[] = 'Enter your google plus url';
        }

        if( empty($ph) ) {
            $errors[] = 'Enter your phone number';
        }

        if( empty($contact) ) {
            $errors[] = 'Enter your contact email address';
        }

        if( empty($copy) ) {
            $errors[] = 'Enter your copyright details';
        }

        if(!empty($errors)) {
            echo "<div class='alert alert-danger'>";
            foreach ($errors as $error) {
                echo $error;
                echo '<br/>';
            }
            echo '</div>';
        } else {

            if(!empty($logo_name)) {
                $rand = uniqid();
                $logo_new = $rand.'.'.$logo_ext;
            }           

            $column_name = array('fb', 'tw', 'ins', 'gp', 'phone', 'contact', 'copyright');
            if(!empty($logo_name)) {
                array_push($column_name, 'logo');
            }

            $column_value = array($fb, $tw, $ins, $gp, $ph, $contact, $copy);
            if(!empty($logo_name)) {
                array_push($column_value, $logo_new);
            }

            $query = $customFunction->updateData('admin', $column_name, $column_value, 'id', 1);          

            if( $query ) {
                if(!empty($logo_name)) {
                   if( move_uploaded_file($logo_tmp, $upload_folder."$logo_new")) {
                        echo "<div class='alert alert-success'>Settings Changed</div>";
                        // delete file
                        @unlink("../images/logo/$logo_img_d");
                        $customFunction->redirect('settings.php', 3);
                    } else {
                        echo "<div class='alert alert-danger'>File is not uploaded.</div>";
                        echo mysqli_error($connection); 
                    }   
                } else {
                    echo "<div class='alert alert-success'>Settings Changed</div>";
                    $customFunction->redirect('settings.php', 3);
                }      
            } else {
                echo "<div class='alert alert-danger'>Somethign went wrong.</div>";
                echo mysqli_error($connection);
            }

        }
    }
}

?>
                <form role="form" method="POST" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']);?>" enctype="multipart/form-data">
                <div class="col-md-6">
                    <div class="form-group">
                        <div class="row">
                            <div class="col-md-6">
                                <label>Change Logo</label>
                                <input type="file" name="logo">
                            </div>
                            <div class="col-md-6">
                                <img src="../images/logo/<?php echo $logo_img_d; ?>" alt="" class="img-responsive">
                            </div>
                        </div>
                        
                    </div>
                    <div class="form-group">
                        <label>Facebook</label>
                        <input type="text" name="fb" value="<?php echo $fb; ?>" class="form-control">
                    </div>
                    <div class="form-group">
                        <label>Twiiter</label>
                        <input type="text" name="tw" value="<?php echo $tw; ?>" class="form-control">
                    </div>
                    <div class="form-group">
                        <label>Instagram</label>
                        <input type="text" name="ins" value="<?php echo $ins; ?>"" class="form-control">
                    </div>                   
                    <div class="form-group">                            
                        <input type="submit" name="submit" value="Change Settings" value="Change Settings" class="btn btn-success" >
                    </div>
                </div>     
                <div class="col-md-6">
                     <div class="form-group">
                        <label>Google Plus</label>
                        <input type="text" name="gp" value="<?php echo $gp; ?>" class="form-control">
                    </div>
                    <div class="form-group">
                        <label>Phone</label>
                        <input type="text" name="ph" value="<?php echo $ph; ?>" class="form-control">
                    </div>
                    <div class="form-group">
                        <label>Contact</label>
                        <input type="text" name="contact" value="<?php echo $contact; ?>" class="form-control">
                    </div>
                    <div class="form-group">
                        <label>Copyright</label>
                        <input type="text" name="copyright" value="<?php echo $copy; ?>" class="form-control">
                    </div>
                    
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