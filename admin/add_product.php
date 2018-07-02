<?php 
require_once('includes/header.php');
$connection  = $database->connect;
$customFunction = new customFunction();
?>
    <div id="wrapper">
        <!-- Navigation -->
        <?php require_once('includes/nav.php'); ?>
        <div id="page-wrapper">
            <div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header">Add Product</h1>
                </div>                
            </div>           
            <div class="row">
                <div class="col-md-6">  
<?php
$customFunction = new customFunction();
$connection  = $database->connect;

if( isset($_POST['submit']) && $_POST['submit'] == 'Add New Product' ) {    
    
    $p_title    = $customFunction->inputvalid($_POST['p_title']);
    $p_price    = $customFunction->inputvalid($_POST['p_price']);
    $p_des      = $customFunction->inputvalid($_POST['p_des']);
    $p_brand    = $customFunction->inputvalid($_POST['p_brand']);
    
    if( isset($_FILES['p_img']['name']) ) {

        $p_img_tmp      = $_FILES['p_img']['tmp_name'];
        $p_img_name     = $_FILES['p_img']['name'];
        $p_img_type     = $_FILES['p_img']['type'];
        $p_img_size     = $_FILES['p_img']['size'];

        $allowable      = array('jpg', 'png', 'jpeg', 'gif');
        $explode        = explode('.', $p_img_name);
        $p_img_ext      = @$explode[1];      
        $upload_folder  = '../images/product/';

    }

    $p_qnt          = $customFunction->inputvalid($_POST['p_qnt']);
    $p_model        = $customFunction->inputvalid($_POST['p_model']);
    $p_available    = $customFunction->inputvalid($_POST['p_available']);
    $p_cond         = $customFunction->inputvalid($_POST['p_cond']);
    $p_cat          = $customFunction->inputvalid($_POST['p_cat']);
    $p_sub          = isset($_POST['p_sub']) ? $customFunction->inputvalid($_POST['p_sub']) : '';

    $errors     = array();
    $query = mysqli_query($connection, "SELECT p_title FROM product WHERE p_title = '$p_title' ");
    $num_row = mysqli_num_rows($query);

    if( isset($p_title, $p_price, $p_des, $p_brand, $p_model, $p_qnt, $p_available, $p_cond, $p_cat, $p_sub)) {

        if( empty($p_title) ) {
            $errors[] = 'Enter your product title';
        } elseif( strlen($p_title) < 2 || strlen($p_title) > 100 ) {
            $errors[] = 'Please enter product title within 2-100 characters';
        } elseif( $num_row == 1 ) {
            $errors[] = 'Your product name is already exist';
        }

        if( empty($p_price) ) {
            $errors[] = 'Enter your product price';
        }

        if( empty($p_des) ) {
            $errors[] = 'Enter your product description';
        }

        if( empty($p_brand) ) {
            $errors[] = 'Enter your product brand';
        }

        if( empty($p_img_name) ) {
            $errors[] = 'Upload your product image';
        } elseif( !in_array($p_img_ext, $allowable)  ) {
            $errors[] = 'We only accepting jpg, jpeg, png and gif format image';
        } elseif ( $p_img_size > 5000000 ) {
            $errors[] = 'Uploaded file size is too big';
        }

        if( empty($p_model) ) {
            $errors[] = 'Enter your product model';
        }

        if( empty($p_qnt) ) {
            $errors[] = 'Enter your product description';
        }

        if( empty($p_available) ) {
            $errors[] = 'Enter your product availability';
        }

        if( empty($p_cond) ) {
            $errors[] = 'Enter your product condition';
        }

        if( empty($p_cat) ) {
            $errors[] = 'Enter your product category';
        }

        if( empty($p_sub) ) {
            $errors[] = 'Enter your product sub category';
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
            $p_img_new = $rand.'.'.$p_img_ext;

            $column_name = array('p_title', 'p_price', 'p_des', 'p_image', 'p_model', 'p_qnt', 'p_available', 'p_cond', 'br_id', 'cat_id', 'sub_id', 'is_active');
            $column_values = array($p_title, $p_price, $p_des, $p_img_new, $p_model, $p_qnt, $p_available, $p_cond, $p_brand, $p_cat, $p_sub, 1);
            $query = $customFunction->insert_data('product', $column_name, $column_values);

            if( $query ) {               
                if( move_uploaded_file($p_img_tmp, $upload_folder."$p_img_new")) {
                    echo "<div class='alert alert-success'>New product added</div>";
                    $customFunction->redirect('all_product.php', 3);
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
                            <label>Product Title</label>
                            <input type="text" name="p_title" class="form-control" value="<?php if(isset($_POST['p_title'])) echo $_POST['p_title'] ?>" placeholder="Product Title" >
                        </div>
                        <div class="form-group">
                            <label>Product Price</label>
                            <input type="number" name="p_price" class="form-control" value="<?php if(isset($_POST['p_price'])) echo $_POST['p_price'] ?>" placeholder="Product Price" >
                        </div>
                        <div class="form-group">
                            <label>Product Description</label>
                            <textarea name="p_des" class="form-control" rows="6" cols="33"><?php if(isset($_POST['p_des'])) echo $_POST['p_des'] ?></textarea>
                        </div>
                        <div class="form-group">
                            <label>Product Image</label>
                            <input type="file" name="p_img">
                        </div>
                        <div class="form-group">
                            <label>Product Brand</label>
                            <select name="p_brand" class="form-control">
                                <option value="">--Select--</option>
                                <?php
                                $allBrand = $customFunction->getAllData('brand', 'br_id', 'DESC'); 
                                while ( $row = mysqli_fetch_array($allBrand) ) {
                                    $br_id     = (int) $row['br_id'];
                                    $br_name   =  $row['br_name'];
                                    echo "<option value='$br_id'>$br_name</option>";
                                }  
                                ?>
                            </select>
                        </div>
                        <div class="form-group">
                            <label>Product Model</label>
                            <input type="text" name="p_model" class="form-control" value="<?php if(isset($_POST['p_model'])) echo $_POST['p_model'] ?>" placeholder="Product Model" >
                        </div>
                        <div class="form-group">
                            <label>Product Quantity</label>
                            <select name="p_qnt" id="" class="form-control">
                                <option value="">--Select---</option>
                                <?php
                                for ( $i = 1; $i< 21; $i++) {
                                    echo "<option value='$i'>$i</option>";
                                }
                                ?>
                            </select>                            
                        </div>
                        <div class="form-group">
                            <label>Product Available</label>
                            <select name="p_available" id="" class="form-control">
                                <option value="">--Select--</option>
                                <option value="1">In Stock</option>
                                <option value="0">Sold Out</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label>Product Condition</label>
                            <select name="p_cond" id="" class="form-control">
                                <option value="">--Select--</option>
                                <option value="1">New</option>
                                <option value="2">Old</option>
                                <option value="3">Used</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label>Category</label>
                            <select name="p_cat" id="p_cat" class="form-control">
                                <option value="">--Select--</option>
                                <?php
                                $allCat = $customFunction->getAllData('category', 'cat_id', 'DESC'); 
                                while ( $row = mysqli_fetch_array($allCat) ) {
                                    $cat_id     = (int) $row['cat_id'];
                                    $cat_name   =  $row['cat_name'];
                                    echo "<option value='$cat_id'>$cat_name</option>";
                                }  
                                ?>
                            </select>
                        </div>
                        <div class="form-group">
                            <label>Sub Category</label>
                            <div class="sub_result"></div>
                        </div>
                        <div class="form-group">                            
                            <input type="submit" name="submit" value="Add New Product" class="btn btn-success" >
                        </div>
                    </form>
                </div>               
            </div>           
        </div> 
    </div>
    <!-- /#wrapper -->
<?php require_once('includes/js.php'); ?>
<script type="text/javascript">
    $('document').ready(function() {

        $('#p_cat').change(function() {
            var cat_id = $('#p_cat').val();
            
            $.ajax({
                type : 'POST', 
                dataType : 'html',
                data : {
                    'cat_id' : cat_id
                },
                url : 'getSubCategory.php', 
                beforeSend : function () {
                    $('.sub_result').html( 'Loading...' );
                },
                success : function ( result ) {
                    $('.sub_result').html( result );
                }
            });
        });
    });
</script>
<?php require_once('includes/footer.php'); ?>