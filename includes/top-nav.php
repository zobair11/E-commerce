<?php
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

?>
<div class="header_top"><!--header_top-->
	<div class="container">
		<div class="row">
			<div class="col-sm-6">
				<div class="contactinfo">
					<ul class="nav nav-pills">
						<li><a href="#"><i class="fa fa-phone"></i> <?php echo $ph; ?></a></li>
						<li><a href="#"><i class="fa fa-envelope"></i> <?php echo $contact; ?></a></li>
					</ul>
				</div>
			</div>
			<div class="col-sm-6">
				<div class="social-icons pull-right">
					<ul class="nav navbar-nav">
						<li><a href="<?php echo $fb; ?>"><i class="fa fa-facebook"></i></a></li>
						<li><a href="<?php echo $tw; ?>"><i class="fa fa-twitter"></i></a></li>
						<li><a href="<?php echo $ins; ?>"><i class="fa fa-linkedin"></i></a></li>						
						<li><a href="<?php echo $gp; ?>"><i class="fa fa-google-plus"></i></a></li>
					</ul>
				</div>
			</div>
		</div>
	</div>
</div><!--/header_top-->