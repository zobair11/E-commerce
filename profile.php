<?php include('includes/header.php');?>
	<header id="header"><!--header-->
		<?php
		include('includes/top-nav.php');
		include('includes/middle-nav.php');
		include('includes/main-nav.php');
		if( !isset($_SESSION['logged_user']) && $_SESSION['logged_user'] =='' ) {    
		    $CustomFunction->redirect('signup.php');   
		    exit(); 
		}

		$sessionId = (int) $_SESSION['logged_user'];
		$allData = $customFunction->getAllData('user', 'u_id', 'u_id', $sessionId);
		$row 	= mysqli_fetch_array($allData);
		$name 	= $row['name'];
		$email 	= $row['email'];
		?>
	</header><!--/header-->
	<section id="form"><!--form-->
		<div class="container">
			<div class="row">
				<div class="col-sm-6">
					<div class="login-form"><!--login form-->
						<h2>Edit your  account</h2>
						<div id="sub_result"></div>
						<form action="#" id="doEditAccount">
							<input type="text" name="name" value="<?php echo $name; ?>" placeholder="Name" />
							<input type="email" name="email" value="<?php echo $email; ?>"  placeholder="Email Address" />
							<input type="password" name="pass" placeholder="Change Password">
							<button type="submit" class="btn btn-default">Edit Account</button>
						</form>
					</div><!--/login form-->
				</div>				
			</div>
		</div>
	</section><!--/form-->
	
	
	<?php 
	require_once('includes/bottom-nav.php');
	require_once('includes/js.php');
	?>
	<script type="text/javascript">
	    $('document').ready(function() {
	        $('#doEditAccount').submit(function( e ) {
	        	e.preventDefault();
	            var data = $( this ).serialize();          
	            $.ajax({
	                type : 'POST', 
	                dataType : 'html',
	                data : data,
	                url : 'doEditAccount.php', 
	                beforeSend : function () {
	                    $('#sub_result').html( 'Validating...' );
	                },
	                success : function ( result ) {
	                    $('#sub_result').html( result );
	                }
	            });
	        });
	    });
	</script>
	<?php
	require_once('includes/footer.php');
	?>