<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="">
    <title>Shop | E-Shopper</title>
    <link href="assets/front/css/bootstrap.min.css" rel="stylesheet">
    <link href="assets/front/css/font-awesome.min.css" rel="stylesheet">
    <link href="assets/front/css/prettyPhoto.css" rel="stylesheet">
    <link href="assets/front/css/price-range.css" rel="stylesheet">
    <link href="assets/front/css/animate.css" rel="stylesheet">
	<link href="assets/front/css/main.css" rel="stylesheet">
	<link href="assets/front/css/responsive.css" rel="stylesheet">
    <!--[if lt IE 9]>
    <script src="js/html5shiv.js"></script>
    <script src="js/respond.min.js"></script>
    <![endif]-->
    <link rel="shortcut icon" href="assets/front/images/ico/favicon.ico">
    <link rel="apple-touch-icon-precomposed" sizes="144x144" href="assets/front/images/ico/apple-touch-icon-144-precomposed.png">
    <link rel="apple-touch-icon-precomposed" sizes="114x114" href="assets/front/images/ico/apple-touch-icon-114-precomposed.png">
    <link rel="apple-touch-icon-precomposed" sizes="72x72" href="assets/front/images/ico/apple-touch-icon-72-precomposed.png">
    <link rel="apple-touch-icon-precomposed" href="assets/front/images/ico/apple-touch-icon-57-precomposed.png">
</head><!--/head-->

<body>
	<header id="header"><!--header-->
		<div class="header_top"><!--header_top-->
			<div class="container">
				<div class="row">
					<div class="col-sm-6 ">
						<div class="contactinfo">
							<ul class="nav nav-pills">
								<li><a href=""><i class="fa fa-phone"></i> +254701964</a></li>
								<li><a href=""><i class="fa fa-envelope"></i> info@domain.com</a></li>
							</ul>
						</div>
					</div>
					<div class="col-sm-6">
						<div class="social-icons pull-right">
							<ul class="nav navbar-nav">
								<li><a href=""><i class="fa fa-facebook"></i></a></li>
								<li><a href=""><i class="fa fa-twitter"></i></a></li>
								<li><a href=""><i class="fa fa-linkedin"></i></a></li>
								<li><a href=""><i class="fa fa-dribbble"></i></a></li>
								<li><a href=""><i class="fa fa-google-plus"></i></a></li>
							</ul>
						</div>
					</div>
				</div>
			</div>
		</div><!--/header_top-->

		<div class="header-middle"><!--header-middle-->
			<div class="container">
				<div class="row">
					<div class="col-sm-4">
						<div class="logo pull-left">
							<a href="index.php"><img src="assets/front/images/home/logo.png" alt="" /></a>
						</div>

					</div>
					<div class="col-sm-8">
						<div class="shop-menu pull-right">
							<ul class="nav navbar-nav">
                <?php if($user->is_logged_in() && $_SESSION['Role']=="1"){ echo "<li><a href='admin/index.php'><i class='fa fa-user'></i> Administrator</a></li>"; }else if($user->is_logged_in() && $_SESSION['Role']!="1") { echo "<li><a href=''><i class='fa fa-user'></i> Account"?><?php if(isset($_SESSION['username'])){echo "(" . $_SESSION['username'] . ")";}"</a></li>"; } ?>
								<li><a href="checkout.php"><i class="fa fa-crosshairs"></i> Checkout</a></li>
								<li><a href="cart.php"><i class="fa fa-shopping-cart"></i> Cart(<?php  if(isset($_SESSION['cart_info'])){echo count($_SESSION['cart_info']);}else { echo "0";}?>)</a></li>
								<?php if($user->is_logged_in()){ echo "<li><a href='logout.php'><i class='fa fa-sign-out'></i> Logout</a></li>"; }else { echo "<li><a href='login.php'><i class='fa fa-lock'></i> Login</a></li>"; } ?>
							</ul>
						</div>
					</div>
				</div>
			</div>
		</div><!--/header-middle-->

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
								<li><a href="index.php" class="<?php if(isset($activeHome)){echo $activeHome;} ?>">Home</a></li>
								<li class="dropdown"><a href="#" class="<?php if(isset($active)){echo $active;} ?>">Categories<i class="fa fa-angle-down"></i></a>
                                    <ul role="menu" class="sub-menu">
                                    <?php $categories = $user->fetch_categories(); ?>
                                      <?php foreach ($categories as $item) :?>
                                        <li><a href="shop.php?cat=<?php echo $item['Id'];?>"><?php echo $item['Name'];?></a></li>
                                      <?php endforeach; ?>
                                    </ul>
                          </li>
                <?php if($user->is_logged_in()): ?>
                <li class="dropdown"><a href="#" class="">My Account<i class="fa fa-angle-down"></i></a>
                    <ul role="menu" class="sub-menu">
                        <li><a href="shopping-list.php" class="">Shopping List</a></li>
          							<li><a href="blog-single.html" class="">Edit Profile</a></li>
                      </ul>
                 </li>
                <?php endif;?>
								<li><a href="contact-us.php" class="<?php if(isset($activeContactUs)){echo $activeContactUs;} ?>">Contact Us</a></li>
							</ul>
						</div>
					</div>
					<div class="col-sm-3">
						<div class="search_box pull-right">
              <form method ='get' action="shop.php" >
                <input type="text" placeholder="Search" name = 'search'/>
              </form>
						</div>
					</div>
				</div>
				</div>
			</div>
	</header>
