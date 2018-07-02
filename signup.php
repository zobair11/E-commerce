<?php include('includes/header.php');?>
	<header id="header"><!--header-->
		<?php
		include('includes/top-nav.php');
		include('includes/middle-nav.php');
		include('includes/main-nav.php');
		$customFunction->isLoginExit();
		?>
	</header><!--/header-->
	
	<section id="form"><!--form-->
		<div class="container">
			<div class="row">
				<div class="col-sm-4 col-sm-offset-1">
				
					<div class="login-form"><!--login form-->
						<h2>Login to your account</h2>
						<div id="sub_result2"></div>
						<form action="#" id="doLogin">							
							<input type="email" name="email" placeholder="Email Address" />
							<input type="password" name="password" placeholder="Password" />
							<button type="submit" class="btn btn-default">Login</button>
						</form>
					</div><!--/login form-->
				</div>
				<div class="col-sm-1">
					<h2 class="or">OR</h2>
				</div>
				<div class="col-sm-4">
					<div class="signup-form"><!--sign up form-->
						<h2>New User Signup!</h2>
						<div id="sub_result"></div>
						<form action="#" id="doSignup">
							<input type="text"  name="name" placeholder="Name"/>
							<input type="email" name="email" placeholder="Email Address"/>
							<input type="password" name="password" placeholder="Password"/>
							<button type="submit" class="btn btn-default">Signup</button>
						</form>
					</div><!--/sign up form-->
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

	        $('#doSignup').submit(function( e ) {
	        	e.preventDefault();
	            var data = $( this ).serialize();          
	            $.ajax({
	                type : 'POST', 
	                dataType : 'html',
	                data : data,
	                url : 'doSignup.php', 
	                beforeSend : function () {
	                    $('#sub_result').html( 'Validating...' );
	                },
	                success : function ( result ) {
	                    $('#sub_result').html( result );
	                }
	            });
	        });

	        $('#doLogin').submit(function( e ) {
	        	e.preventDefault();
	            var data = $( this ).serialize();          
	            $.ajax({
	                type : 'POST', 
	                dataType : 'html',
	                data : data,
	                url : 'doLogin.php', 
	                beforeSend : function () {
	                    $('#sub_result2').html( 'Validating...' );
	                },
	                success : function ( result ) {
	                    $('#sub_result2').html( result );
	                }
	            });
	        });


	    });
	</script>
	<?
	require_once('includes/footer.php');
	?>