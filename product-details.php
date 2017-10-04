<?php require('func/config.php'); ?>
<?php
	$id = trim($_GET['id']);
	$product_query = "select * from shop_items where Id = $id";
	$product = $user->fetch_products($product_query);
 ?>
<?php include('includes/front/header.php');?>

	<section>
		<div class="container">
			<div class="row">

				<?php include('includes/front/sidebar.php');?>
				<div class="col-sm-9 padding-right">
					<?php foreach ($product as $item) :?>
					<div class="product-details"><!--product-details-->
						<div class="col-sm-5">
							<div class="view-product">
								<img alt="product 1" src="assets/uploads/<?php echo $item['Image'];?>">
							</div>
						</div>
						<div class="col-sm-7">
							<div class="product-information"><!--/product-information-->
								<!-- <img src="assets/front/images/product-details/new" class="newarrival" alt="" /> -->
								<h2><?php echo $item['Name'];?></h2>
								<p>Web ID: <?php echo $item['Id'];?></p>
								<!-- <img src="assets/front/images/product-details/rating.png" alt="" /> -->
								<span>
									<span>Ksh <?php echo $item['Price'];?></span>

									<a ref="<?php echo $item['Id'];?>" class="btn btn-default add-cart-button" href="cart.php"><i class="fa fa-shopping-cart"></i>Add to cart</a>
								</span>
								<p><b>Availability:</b> In Stock</p>
								<p><b>Condition:</b> New</p>
								<p><b>Brand:</b> <?php echo $user->getCategory($item['Brand']);?></p>
								<p><b>Description:</b><br> <?php echo $item['Description'];?></p>
								<!-- <a href=""><img src="assets/front/images/product-details/share.png" class="share img-responsive"  alt="" /></a> -->
							</div><!--/product-information-->
						</div>
					</div><!--/product-details-->
				<?php endforeach; ?>
				<div class="recommended_items"><!--recommended_items-->
						<h2 class="title text-center">Featured items</h2>

						<div id="recommended-item-carousel" class="carousel slide" data-ride="carousel">
							<div class="carousel-inner">
								<?php
									$similar_products_query = "select * from shop_items where FeaturedItem = 1 LIMIT 3";
									$similar_products = $user->fetch_products($similar_products_query);
								 ?>
								<div class="item active">
									<?php include('includes/front/similar-items.php');?>
									</div>
							</div>
						</div>
					</div><!--/recommended_items-->

				</div>
			</div>
		</div>
	</section>

<?php include('includes/front/footer.php');?>
