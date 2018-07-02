<?php include('includes/header.php');?>
	<header id="header"><!--header-->
		<?php
		include('includes/top-nav.php');
		include('includes/middle-nav.php');
		include('includes/main-nav.php');
		?>
	</header><!--/header-->
	
	<section>
		<div class="container">
			<div class="row">
				<?php include('includes/sidebar.php');?>				
				<div class="col-sm-9 padding-right">
<?php
$p_id = (int) $_GET['p_id'];
$allData = mysqli_query($connection, "SELECT p.p_id, p.p_des, p.p_price, p.p_title, p.p_image, p.p_cond, p.p_available, p.p_model, p.is_active, p.p_qnt, c.cat_id, c.cat_name, s.sub_id, s.sub_name, brand.br_id, brand.br_name FROM product AS p LEFT JOIN category AS c ON c.cat_id = p.cat_id LEFT JOIN sub_cat AS s ON s.sub_id = p.sub_id LEFT JOIN brand ON brand.br_id = p.br_id WHERE p.p_id = $p_id ORDER BY p.p_id DESC ");

$upload_folder = "../images/product/";
$productRow = mysqli_fetch_array($allData);

$p_id           = (int) $productRow['p_id'];
$p_title        = $productRow['p_title'];
$p_des        	= $productRow['p_des'];
$p_price        = number_format($productRow['p_price']);
$p_img          = $productRow['p_image'];
$p_brand        = $productRow['br_name'];
$p_cond         = $productRow['p_cond'];  
$p_qnt         = $productRow['p_qnt'];  

if( $p_cond == 1 ) {
    $p_cond =  "New";
} elseif( $p_cond == 2 ) {
    $p_cond = "Old";
} elseif( $p_cond == 3 ) {
    $p_cond = "Used";
}
$p_stock        = $productRow['p_available'];

if($p_stock == 1) {
    $p_stock = "In Stock";
} elseif($p_stock == 0) {
    $p_stock = "Sold Out!";
}
$p_model        = $productRow['p_model'];
$p_cat          = $productRow['cat_name'];
$p_sub          = $productRow['sub_name'];
$is_active      = $productRow['is_active'];        
if( $is_active == 1) {
    $status = "<span class='label label-success'>Active</span>";
} elseif( $is_active == 0 ) {
    $status = "<span class='label label-danger'>In-active</span>";
}
?>

					<div class="product-details"><!--product-details-->
						<div class="col-sm-5">
							<div class="view-product">
								<img src="images/product/<?php echo $p_img; ?>" alt="" class="img-responsive" />
							</div>
							<div id="similar-product" class="carousel slide" data-ride="carousel">
								
								  <!-- Wrapper for slides -->
								    <!-- <div class="carousel-inner">
										<div class="item active">
										  <a href=""><img src="images/product-details/similar1.jpg" alt=""></a>
										  <a href=""><img src="images/product-details/similar2.jpg" alt=""></a>
										  <a href=""><img src="images/product-details/similar3.jpg" alt=""></a>
										</div>
										<div class="item">
										  <a href=""><img src="images/product-details/similar1.jpg" alt=""></a>
										  <a href=""><img src="images/product-details/similar2.jpg" alt=""></a>
										  <a href=""><img src="images/product-details/similar3.jpg" alt=""></a>
										</div>
										<div class="item">
										  <a href=""><img src="images/product-details/similar1.jpg" alt=""></a>
										  <a href=""><img src="images/product-details/similar2.jpg" alt=""></a>
										  <a href=""><img src="images/product-details/similar3.jpg" alt=""></a>
										</div>
										
									</div> -->

								  <!-- Controls -->
								  <a class="left item-control" href="#similar-product" data-slide="prev">
									<i class="fa fa-angle-left"></i>
								  </a>
								  <a class="right item-control" href="#similar-product" data-slide="next">
									<i class="fa fa-angle-right"></i>
								  </a>
							</div>

						</div>
						<div class="col-sm-7">
							<div class="product-information"><!--/product-information-->								
								<h2><?php echo $p_title; ?></h2>
								<p>Model: <?php echo $p_model; ?></p>
								<div>
<?php
$getAllReview = mysqli_query($connection, "SELECT SUM(rating), r_id AS totalReview FROM rating WHERE p_id = '$p_id' GROUP BY r_id ");

$fetchRow = mysqli_fetch_array($getAllReview);
$numReview = mysqli_num_rows($getAllReview);
$totalReview = $fetchRow['totalReview'];
$avgReview = ceil($totalReview / 5);
$remaining = 5 - $avgReview;
for ($i=1; $i <= $avgReview ; $i++) { 
	echo '<i class="fa fa-star" aria-hidden="true"></i> ';
}
for ($i=1; $i <= $remaining ; $i++) { 
	echo '<i class="fa fa-star-o" aria-hidden="true"></i>	';
}
echo '<hr/>';
?>

								</div>
								
								<span>
								<div id="sub_result2"></div>
								<form action="#" id="doAddToCart">
									<span>US $<?php echo $p_price; ?></span>
									<label>Quantity:</label>
									<input type="number" name="qnt" value="" max="<?php echo $p_qnt; ?>" min="1" />
									<input type="hidden" value="<?php echo $p_id ?>" name="p_id">
									<button type="submit" class="btn btn-fefault cart">
										<i class="fa fa-shopping-cart"></i>
										Add to cart					
									</button>
								</form>
								</span>
								<p><b>Availability:</b> <?php echo $p_stock; ?></p>
								<p><b>Condition:</b> <?php echo $p_cond; ?></p>
								<p><b>Brand:</b> <?php echo $p_brand; ?></p>
							</div><!--/product-information-->
						</div>
					</div><!--/product-details-->
					
					<div class="category-tab shop-details-tab"><!--category-tab-->
						<div class="col-sm-12">
							<ul class="nav nav-tabs">
								<li class="active"><a href="#details" data-toggle="tab">Details</a></li>
								<li><a href="#reviews" data-toggle="tab">Reviews (<?php echo $numReview; ?>)</a></li>
							</ul>
						</div>
						<div class="tab-content">
							<div class="tab-pane fade active in" id="details" >
								<div class="col-sm-12">
									<div class="product-image-wrapper">
										<div class="single-products">
											<div class="productinfo text-center">
												<br/>
												<p><?php echo $p_des; ?></p>
											</div>
										</div>
									</div>
								</div>
							</div>
							
							<div class="tab-pane" id="reviews" >
								<div class="col-sm-12">	
									<h3>All Reviews</h3>
									<?php
									$query = $customFunction->getAllData('rating', 'p_id', 'DESC', $p_id);
									while ( $row = mysqli_fetch_array($query) ) {
										$p_id 		= (int) $row['p_id'];
										$r_id 		= (int) $row['r_id'];
										$name 		= $row['name'];
										$review 	= $row['review'];
										$dated 		= $row['dated'];
										$rating 	= $row['rating'];
										$remaining 	= ceil(5-$rating); 
										?>
										<fieldset>
											<legend><?php echo $name; ?></legend>
											<p>
										<?php
										for ($i=1; $i <= $rating ; $i++) { 
											echo '<i class="fa fa-star" aria-hidden="true"></i> ';
										}
										for ($i=1; $i <= $remaining ; $i++) { 
											echo '<i class="fa fa-star-o" aria-hidden="true"></i>	';
										}
										?>
												
											</p>
											<p><?php echo $dated; ?></p>
											<p><?php echo $review; ?></p>
										</fieldset>
										<?php
									}
									?>
									

									
									<hr>								
									<form action="#" id="doRating">
										<span>
											<input type="text" name="name" placeholder="Your Name"/>
											<input type="email" name="email" placeholder="Email Address"/>
										</span>
										<textarea name="review" ></textarea>
										<b>Rating: </b> 
										<select name="rating" id="">
											<option value="">--Select--</option>
											<?php
											for ( $r = 0; $r <= 5; $r++) {
												echo "<option value='$r'>$r</option>";
											}
											?>
										</select>
										<br/>
										<br/>
										<div id="sub_result"></div>
										<input type="hidden" name="p_id" value="<?php echo $p_id;?>">
										<button type="submit" name="submit" class="btn btn-default pull-right">
											Submit
										</button>
									</form>
								</div>
							</div>
							
						</div>
					</div><!--/category-tab-->
				</div>
			</div>
		</div>
	</section>
	
	<?php 
	require_once('includes/bottom-nav.php');
	require_once('includes/js.php');
	?>
	<script type="text/javascript">
	    $('document').ready(function() {

	        $('#doRating').submit(function( e ) {
	        	e.preventDefault();
	            var data = $( this ).serialize();          
	            $.ajax({
	                type : 'POST', 
	                dataType : 'html',
	                data : data,
	                url : 'doRating.php', 
	                beforeSend : function () {
	                    $('#sub_result').html( 'Validating...' );
	                },
	                success : function ( result ) {
	                    $('#sub_result').html( result );
	                }
	            });
	        });

	        $('#doAddToCart').submit(function( e ) {
	        	e.preventDefault();
	            var data = $( this ).serialize();          
	            $.ajax({
	                type : 'POST', 
	                dataType : 'html',
	                data : data,
	                url : 'doAddToCart.php', 
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