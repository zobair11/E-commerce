<?php 
require_once('includes/init.php');
$database = new Database();
$CustomFunction = new CustomFunction();

if( isset($_SESSION['admin_email']) && $_SESSION['admin_email'] != '' )    {
    $CustomFunction->redirect('index.php');    
    exit();     
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
    <title>Admin Panel</title>
    <link href="vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <link href="vendor/metisMenu/metisMenu.min.css" rel="stylesheet">    
    <link href="dist/css/sb-admin-2.css" rel="stylesheet">   
    <link href="vendor/morrisjs/morris.css" rel="stylesheet">    
    <link href="vendor/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">    
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->
</head>
<body>
    <div id="wrapper">
        <!-- Navigation -->
        
        <div id="page-wrapper">
            <div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header">Login</h1>
                </div>                
            </div>           
            <div class="row">
                <div class="col-md-6">
                    
                    <div class="panel-heading">
                        <h3 class="panel-title">Please Sign In</h3>

                    </div>
<div class="panel-heading">
<?php
require_once('includes/functions.php');
$customFunction = new CustomFunction();
$connection = $database->connect;
//print_r($connection);

if( isset($_POST['submit']) && $_POST['submit'] == 'Log In' ) {

    $email  = $customFunction->inputvalid($_POST['email']);
    $pass   = $customFunction->inputvalid($_POST['password']);
    $hash_password = hash('sha256', $pass);
    $errors = array();

    $check  = mysqli_query($connection, "SELECT email, pass FROM admin WHERE email = '$email' AND pass = '$hash_password' ");
    $num_row = mysqli_num_rows($check);
   
    if( isset($email, $pass) ) {
        if( empty($email) && empty($pass) ) {
            $errors[] = 'All fields are required'; 
        } else {
            if( empty($email) ) {
                $errors[] = 'Email address required';
            } elseif ( empty($pass) ) {
                $errors[] = 'Password required';
            } elseif ( $num_row == 0) {
                $errors[] = 'Your username or password is incorrect';
            }
        }

        if( !empty($errors) ) {
            echo "<div class='alert alert-danger'>";
            foreach ($errors as $error) {
                echo $error;
            }
            echo '</div>';
        } else {
            echo '<div class="alert alert-success">';
            echo '<strong>Successfully Logged.</strong>';
            $_SESSION['admin_email'] =  $email;
            $customFunction->redirect("index.php");
            echo '</div>';
        }
    }
}
?>
</div>
                    <div class="panel-body">
                        <form role="form" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="POST">
                            <fieldset>
                                <div class="form-group">
                                    <input class="form-control" placeholder="E-mail" name="email" type="email" autofocus value="<?php if(isset($_POST['email'])) echo $_POST['email']; ?>">
                                </div>
                                <div class="form-group">
                                    <input class="form-control" placeholder="Password" name="password" type="password" value="">
                                </div>                                
                                <!-- Change this to a button or input when using this as a form -->
                                <input type="submit" name="submit" value="Log In" class="btn btn-success btn-block">
                            </fieldset>
                        </form>
                    </div>

                </div>               
            </div>           
        </div> 
    </div>
    <!-- /#wrapper -->
<?php 
require_once('includes/js.php');
require_once('includes/footer.php');
?>