<div class="header-middle"><!--header-middle-->
	<div class="container">
		<div class="row">
			<div class="col-sm-4">
				<div class="logo pull-left">
					<a href="index.php"><img src="images/logo/<?php echo $logo_img_d; ?>" alt="" class="img-responsive" /></a>
				</div>						
			</div>
			<div class="col-sm-8">
				<div class="shop-menu pull-right">
					<ul class="nav navbar-nav">
						<?php
						if( isset($_SESSION['logged_user']) && $_SESSION['logged_user'] != '' ) {
						?>
						<li><a href="#"><i class="fa fa-user"></i> Account</a></li>
						<li><a href="#"><i class="fa fa-star"></i> Wishlist</a></li>
						<li><a href="checkout.php"><i class="fa fa-crosshairs"></i> Checkout</a></li>
						<li><a href="add_to_cart.php"><i class="fa fa-shopping-cart"></i> Cart</a></li>
						
						<?php
							echo '<li><a href="profile.php"><i class="fa fa-lock"></i> Profile</a></li>';
							echo '<li><a href="signout.php"><i class="fa fa-lock"></i> Signout</a></li>';
						} else {
						?>
						<li><a href="signup.php"><i class="fa fa-lock"></i> Login</a></li>
						<li><a href="signup.php"><i class="fa fa-lock"></i> Sign Up</a></li>
						<?php } ?>
					</ul>
				</div>
			</div>
		</div>
	</div>
</div><!--/header-middle-->