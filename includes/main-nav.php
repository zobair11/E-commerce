<div class="header-bottom"><!--header-bottom-->
	<div class="container">
		<div class="row">
			<div class="col-sm-9">
				<div class="navbar-header">
					<button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
						<span class="sr-only">Toggle navigation</span>
						<span class="icon-bar"></span>
						<span class="icon-bar"></span>
						<span class="icon-bar"></span>
					</button>
				</div>
				<div class="mainmenu pull-left">
					<ul class="nav navbar-nav collapse navbar-collapse">
						<li><a href="index.php" class="active">Home</a></li>
						<li><a href="shop.php">Shop</a></li>
						<li><a href="blog.php">Blog</a></li>
						<li><a href="contact.php">Contact</a></li>
					</ul>
				</div>
			</div>
			<?php
			$baseurl = basename($_SERVER['PHP_SELF']);
			if( $baseurl !== 'signup.php' && $baseurl !== 'checkout.php' && $baseurl !== 'add_to_cart.php' && $baseurl !== 'profile.php') {
			?>
			<div class="col-sm-3">
				<div class="search_box pull-right">
					<input type="text" placeholder="Search"/>
				</div>
			</div>
			<?php } ?>
		</div>
	</div>
</div><!--/header-bottom-->