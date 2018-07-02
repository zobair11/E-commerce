<div class="col-sm-3">
	<div class="left-sidebar">
		<h2>Category</h2>
		<div class="panel-group category-products" id="accordian"><!--category-productsr-->
			
			<?php
			$allData = mysqli_query($connection, "SELECT * FROM category ORDER BY cat_id DESC");

			while ( $row = mysqli_fetch_array($allData) ) {
				
				$cat_id = (int) $row['cat_id'];				
				$cat_name = $row['cat_name'];

				$getSub = mysqli_query($connection, "SELECT * FROM sub_cat WHERE cat_id = '$cat_id' ");
				$sub_num_row = mysqli_num_rows($getSub);
				?>
				
				<div class="panel panel-default">				
					<div class="panel-heading">
						<h4 class="panel-title">
							<a data-toggle="collapse" data-parent="#accordian" href="#cat_<?php echo $cat_id; ?>">
								<span class="badge pull-right">
								<?php 
								echo $sub_num_row > 0 ? '<i class="fa fa-plus"></i></span>' : '';
								?>	
								</span>							
								<?php echo $cat_name; ?>
							</a>
						</h4>
					</div>
					
					<?php
					
					if( $sub_num_row > 0  ) {
					?>
					<div id="<?php echo "cat_".$cat_id; ?>" class="panel-collapse collapse">
						<div class="panel-body">
							<ul>
								<?php
								
								while ( $row2 = mysqli_fetch_array($getSub) ) {
									$sub_id = (int) $row2['sub_id'];
									$sub_name =  $row2['sub_name'];
									echo "<li><a href='#'>$sub_name</a></li>";
								}	
								?>
							</ul>
						</div>
					</div>

					<?php } ?>

				</div>

				<?php
			}

			?>

				


		</div><!--/category-products-->
	
		<div class="brands_products"><!--brands_products-->
			<h2>Brands</h2>
			<div class="brands-name">
				<ul class="nav nav-pills nav-stacked">
					<?php
					
					$query = $customFunction->getAllData('brand', 'br_id', 'DESC');
					while( $row = mysqli_fetch_array($query) ) {
						$br_name = $row['br_name'];
						echo "<li><a href='#'> <span class='pull-right'>(50)</span>$br_name</a></li>";
					}
					?>					
				</ul>
			</div>
		</div><!--/brands_products-->
					
		<div class="shipping text-center"><!--shipping-->
			<img src="images/home/shipping.jpg" alt="" />
		</div><!--/shipping-->

		<br/>
	
	</div>
</div>