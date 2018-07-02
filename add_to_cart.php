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
		?>
	</header><!--/header-->
	

	<section id="cart_items">
		<div class="container">
			<div class="breadcrumbs">
				<ol class="breadcrumb">
				  <li><a href="#">Home</a></li>
				  <li class="active">Shopping Cart</li>
				</ol>
			</div>
			<div class="table-responsive cart_info">
				<table class="table table-condensed">
					<thead>
						<tr class="cart_menu">
							<td class="image">Item</td>
							<td class="description"></td>
							<td class="price">Price</td>
							<td class="quantity">Quantity</td>
							<td class="total">Total</td>
							<td></td>
						</tr>
					</thead>
					<tbody>
					<?php

					$u_id =  (int) $_SESSION['logged_user'];
					$upload = "images/product/";
					$query = mysqli_query($connection, "SELECT * FROM tmp_cart WHERE u_id = '$u_id' AND is_completed = 0 ");

					if( mysqli_num_rows($query) == 0 ) echo "<div class='well text text-danger'>Your cart is empty</div>";

					$p_id 	= array();
					$p_qnt 	= array();
					while ( $row = mysqli_fetch_array($query) ) {
						$p_id[] 	= (int) $row['p_id'];
						$p_qnt[] 	= (int) $row['qnt'];
					}
					
					$x = count($p_id);
					$cartTotal = array();
					foreach ($p_id as $key => $value) {
						$final_p_qnt = $p_qnt[$key];
						$query = $customFunction->getAllData('product', 'p_id', 'DESC', $value);
						$row2 = mysqli_fetch_array($query);
						$p_title = $row2['p_title'];
						$p_image = $row2['p_image'];
						$p_model = $row2['p_model'];
						$p_price = ceil($row2['p_price']);
						$total_price = ($p_price * $final_p_qnt);
						$cartTotal[] = $total_price;
						?>
						<tr>
							<td class="cart_product">
								<a href=""><img width="100" class="img-responsive" src="<?php echo "$upload{$p_image}"; ?>" alt=""></a>
							</td>
							<td class="cart_description">
								<h4><a href=""><?php echo $p_title; ?></a></h4>
								<p>Model NO: <?php echo $p_model; ?></p>
							</td>
							<td class="cart_price">
								<p><?php echo '$'.$p_price; ?></p>
							</td>
							<td class="cart_quantity">
								<div class="cart_quantity_button">
									<?php echo $final_p_qnt; ?>
								</div>
							</td>
							<td class="cart_total">
								<p class="cart_total_price"><?php echo '$'.$total_price; ?></p>
							</td>
							<td class="cart_delete" valign="top">
							<form action="#" id="doDeleteCart">
								<div id="result"></div>
								<input type="submit" name="Delete" value="Delete" class="btn btn-danger">
								<input type="hidden" name="delete_p_id" value="<?php echo $value; ?>">
							</form>
							</td>
						</tr>
						<?php
						
					}
					?>
						
										
					</tbody>
				</table>
			</div>
		</div>
	</section> <!--/#cart_items-->

	<section id="do_action">
		<div class="container">
			<div class="heading">
				<h3>Total</h3>
			</div>
			<div class="row">
				<div class="col-sm-6">
					<div class="total_area">
						<ul>
							<li>Cart Sub Total <span><?php echo $subtotal = array_sum($cartTotal); ?></span></li>
							<li>Tax <span><?php echo $tax = $subtotal * 0.1; ?></span></li>
							<li>Shipping Cost <span>Free</span></li>
							<li>Total <span><?php echo $subtotal + $tax; ?></span></li>
						</ul>
							<a class="btn btn-default check_out" href="checkout.php">Check Out</a>
					</div>
				</div>
			</div>
		</div>
	</section><!--/#do_action-->

	<?php 
	require_once('includes/bottom-nav.php');
	require_once('includes/js.php');
	?>
	<script type="text/javascript">
	    $('document').ready(function() {

	        $('#doDeleteCart').submit(function( e ) {
	        	e.preventDefault();
	            var data = $( this ).serialize();          
	            $.ajax({
	                type : 'POST', 
	                dataType : 'html',
	                data : data,
	                url : 'doDeleteCart.php', 
	                beforeSend : function () {
	                    $('#result').html( 'Validating...' );
	                },
	                success : function ( result ) {
	                    $('#result').html( result );
	                }
	            });
	        });
	    });
	</script>
	<?php
	require_once('includes/footer.php');
	?>