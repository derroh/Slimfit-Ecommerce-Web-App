<?php
require('func/config.php');
//fetch

if(isset($_GET['cat'])){
	$id = $_GET['cat'];
	$query = "select * from shop_items where Category = $id";
	$featured_products = $user->fetch_products($query);

}else if(isset($_GET['brand'])) {
	$id = $_GET['brand'];
	$query = "select * from shop_items where Brand = $id";
	$featured_products = $user->fetch_products($query);
	# code...
}else if(isset($_GET['search'])) {

	$word = trim($_GET['search']);
	$featured_products = $user->search($word);
	# code...
}else {

	$query = "select * from shop_items";
	$featured_products = $user->fetch_products($query);
}


include('includes/front/header.php');?>

	<section>
		<div class="container">
			<div class="row">

				<?php include('includes/front/sidebar.php');?>

				<div class="col-sm-9 padding-right">
					<div class="features_items"><!--features_items-->
						<h2 class="title text-center">
							<?php
									if(isset($_GET['cat'])){
										echo $user->getCategory($_GET['cat']);
									}else if(isset($_GET['brand'])) {
										$id = $_GET['brand'];
										echo $user->getCategory($id);
										# code...
									}else if(isset($_GET['search'])) {
										echo "Search Results";
										# code...
									}else {
										echo "Available Items";
									}


						 ?></h2>

						 <?php include('includes/front/featured-items.php');?>

						<!--features_items-->
				</div>
			</div>
		</div>
	</section>
<?php include('includes/front/footer.php');?>
