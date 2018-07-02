<?php include('includes/header.php');?>
	<header id="header"><!--header-->
		<?php
		include('includes/top-nav.php');
		include('includes/middle-nav.php');
		include('includes/main-nav.php');
		?>
	</header><!--/header-->
	<section id="cart_items">
		<div class="container">
			<div class="breadcrumbs">
				<ol class="breadcrumb">
				  <li><a href="#">Home</a></li>
				  <li class="active">Check out</li>
				</ol>
			</div><!--/breadcrums-->
			
			<div class="review-payment">
				<h2>Review & Payment</h2>
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
						</tr>
						<?php
						
					}
					?>
						<tr>
							<td colspan="4">&nbsp;</td>
							<td colspan="2">
								<table class="table table-condensed total-result">
									<tr>
										<td>Cart Sub Total</td>
										<td><?php echo '$'.$subtotal = array_sum($cartTotal); ?></td>
									</tr>
									<tr>
										<td>Exo Tax</td>
										<td><?php echo '$'.$tax = $subtotal * 0.1; ?></td>
									</tr>
									<tr class="shipping-cost">
										<td>Shipping Cost</td>
										<td>Free</td>										
									</tr>
									<tr>
										<td>Total</td>
										<td><span><?php echo '$'. ($subtotal + $tax); ?></span></td>
									</tr>
								</table>
							</td>
						</tr>
										
					</tbody>
				</table>
			</div>

			<div class="step-one">
				<h2 class="heading">Checkout</h2>
			</div>			

			<div class="shopper-informations">
				<div class="row">
					<form action="#" id="doOrder">
					<div class="col-sm-5 clearfix">
						<div class="bill-to">
							<p>Bill To</p>
							<div class="form-one">								
								<input name="company" type="text" placeholder="Company Name" required="">
								<input name="email" type="text" placeholder="Email*" required="">
								<input name="title" type="text" placeholder="Title" required ="">
								<input name="fname" type="text" placeholder="First Name *" required ="">
								<input name="mname" type="text" placeholder="Middle Name" required ="">
								<input name="lname" type="text" placeholder="Last Name *" required ="">
								<input name="address" type="text" placeholder="Address 1 *" required ="">								
							</div>
							<div class="form-two">
								<input name="zip" type="text" placeholder="Zip / Postal Code *" required ="">
								<select name="country" required="">
									<option value="">-- Country --</option>
									<option value="un">United States</option>
									<option value="bd">Bangladesh</option>
									<option value="uk">UK</option>
									<option value="in">India</option>
									<option value="pk">Pakistan</option>
									<option value="uc">Ucrane</option>
									<option value="cn">Canada</option>
									<option value="du">Dubai</option>
								</select>
								<select name="state" required="">
									<option value="">-- State / Province / Region --</option>
									<option value="un-s">United States</option>
									<option value="bd-s">Bangladesh</option>
									<option value="uk-s">UK</option>
									<option value="in-s">India</option>
									<option value="pk-s">Pakistan</option>
									<option value="uc-s">Ucrane</option>
									<option value="cn-s">Canada</option>
									<option value="du-s">Dubai</option>
								</select>
								<input name="phone" type="text" placeholder="Phone *" required="">
								<input name="mphone" type="text" placeholder="Mobile Phone" required="">
								<input name="fax" type="text" placeholder="Fax">
								<select name="payment" required="">
									<option value="">-- Payment Option --</option>
									<option value="1">Direct Bank Transfer</option>
									<option value="2">Check Payment</option>
									<option value="3">PayPal</option>
								</select>								
							</div>
						</div>
					</div>
					<div class="col-sm-4">
						<div class="order-message">
							<p>Shipping Order</p>
							<textarea name="message"  placeholder="Notes about your order, Special Notes for Delivery" rows="16"></textarea>
							<div id="sub_result"></div>
							<input type="hidden" name="p_id" value="<?php echo implode(',', $p_id); ?>">
							<input type="hidden" name="u_id" value="<?php echo $u_id; ?>">
							<input name="order_product" type="submit" id="checkout" value="Order Product" class="btn btn-success">
						</div>	
					</div>
					</form>
				</div>
			</div>
		</div>
	</section> <!--/#cart_items-->
	<br/>
	<?php 
	require_once('includes/bottom-nav.php');
	require_once('includes/js.php');
	?>
	<script type="text/javascript">
	    $('document').ready(function() {

	        $('#doOrder').submit(function( e ) {
	        	e.preventDefault();
	            var data = $( this ).serialize();          
	            $.ajax({
	                type : 'POST', 
	                dataType : 'html',
	                data : data,
	                url : 'doOrder.php', 
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