<section id="slider"><!--slider-->
	<div class="container">
		<div class="row">
			<div class="col-sm-12">
				<div id="slider-carousel" class="carousel slide" data-ride="carousel">
				<?php
				$customFunction = new customFunction();
				$query = $customFunction->getAllData('banner', 'b_id', 'DESC');
				$numRow = $customFunction->numRows($query);
				?>
					<ol class="carousel-indicators">
						<?php
						for ($i=0; $i < $numRow ; $i++) { 
							if( $i == 0 ) {
								$active = 'active';
							} else {
								$active = '';
							}
							?>
							<li data-target="#slider-carousel" data-slide-to="<?php echo $i; ?>" class="<?php echo $active; ?>"></li>
							<?php
						}
						?>						
					</ol>
					
					<div class="carousel-inner">
						<?php
						
						$loop = 0;
						while( $row = mysqli_fetch_array($query) ) {

							$b_title		= $row['b_title'];
							$b_sub_title	= $row['b_sub_title'];
							$b_des			= $row['b_des'];
							$b_img			= $row['b_img'];
							$b_button		= $row['b_button'];
							$b_button_url	= $row['b_button_url'];

							if( $loop == 0 ) {
								$active = "active";
							} else {
								$active = "";
							}
							?>
							<div class="item <?php echo $active; ?>">
								<div class="col-sm-6">
									<!-- <h1><span>E</span>-SHOPPER</h1> -->
									<h1><?php echo $b_title; ?></h1>
									<h2><?php echo $b_sub_title; ?></h2>
									<p><?php echo $b_des; ?></p>
									<a href="<?php echo $b_button_url; ?>"><button type="button" class="btn btn-default get"><?php echo $b_button; ?></button></a>
								</div>
								<div class="col-sm-6">
									<img src="images/banner/<?php echo $b_img; ?>" class="girl img-responsive" alt="" />
									<!-- <img src="images/home/pricing.png"  class="pricing" alt="" /> -->
								</div>
							</div>
							<?php
							$loop++;
						}
						?>
						

					</div>
					
					<a href="#slider-carousel" class="left control-carousel hidden-xs" data-slide="prev">
						<i class="fa fa-angle-left"></i>
					</a>
					<a href="#slider-carousel" class="right control-carousel hidden-xs" data-slide="next">
						<i class="fa fa-angle-right"></i>
					</a>
				</div>
				
			</div>
		</div>
	</div>
</section><!--/slider-->