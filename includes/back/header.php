<?php
require('../func/config.php');
if(!$user->is_logged_in()){ header('Location: login'); }
 ?>
<!DOCTYPE html>
<html lang="en">
	<head>
		<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
		<meta charset="utf-8" />
		<title><?php echo $pagetitle; ?> - Slimfit Colections</title>

		<meta name="description" content="Common form elements and layouts" />
		<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0" />

		<!-- bootstrap & fontawesome -->
		<link rel="stylesheet" href="../assets/css/bootstrap.css" />
		<link rel="stylesheet" href="../assets/css/font-awesome.css" />

		<!-- page specific plugin styles -->
		<link rel="stylesheet" href="../assets/css/select2.min.css" />
		<link rel="stylesheet" href="../assets/css/jquery-ui.min.css" />
		<link rel="stylesheet" href="../assets/css/jquery-ui.custom.min.css" />
		<link rel="stylesheet" href="../assets/css/fullcalendar.min.css" />
		<link rel="stylesheet" href="../custom/styles.css" />
		<link rel="stylesheet" href="../assets/css/jquery-ui.custom.min.css" />
		<link rel="stylesheet" href="../assets/css/chosen.min.css" />
		<link rel="stylesheet" href="../assets/css/bootstrap-datepicker3.min.css" />
		<link rel="stylesheet" href="../assets/css/bootstrap-timepicker.min.css" />
		<link rel="stylesheet" href="../assets/css/daterangepicker.min.css" />
		<link rel="stylesheet" href="../assets/css/bootstrap-datetimepicker.min.css" />
		<link rel="stylesheet" href="../assets/css/bootstrap-colorpicker.min.css" />

		<link rel="stylesheet" href="../assets/css/jquery-ui.custom.min.css" />
		<link rel="stylesheet" href="../assets/css/jquery.gritter.min.css" />
		<link rel="stylesheet" href="../assets/css/select2.min.css" />

		<link rel="stylesheet" href="../assets/css/bootstrap-editable.min.css" />

		<!-- text fonts -->
		<link rel="stylesheet" href="../assets/css/ace-fonts.css" />

		<!-- ace styles -->
		<link rel="stylesheet" href="../assets/css/ace.css" class="ace-main-stylesheet" id="main-ace-style" />

		<!--[if lte IE 9]>
			<link rel="stylesheet" href="../assets/css/ace-part2.css" class="ace-main-stylesheet" />
		<![endif]-->

		<!--[if lte IE 9]>
		  <link rel="stylesheet" href="../assets/css/ace-ie.css" />
		<![endif]-->

		<!-- inline styles related to this page -->

		<!-- ace settings handler -->
		<script src="../assets/js/ace-extra.js"></script>

		<!-- HTML5shiv and Respond.js for IE8 to support HTML5 elements and media queries -->

		<!--[if lte IE 8]>
		<script src="../assets/js/html5shiv.js"></script>
		<script src="../assets/js/respond.js"></script>
		<![endif]-->
	</head>

	<body class="no-skin">
		<!-- #section:basics/navbar.layout -->
		<div id="navbar" class="navbar navbar-default">
			<script type="text/javascript">
				try{ace.settings.check('navbar' , 'fixed')}catch(e){}
			</script>

			<div class="navbar-container" id="navbar-container">
				<!-- #section:basics/sidebar.mobile.toggle -->
				<button type="button" class="navbar-toggle menu-toggler pull-left" id="menu-toggler" data-target="#sidebar">
					<span class="sr-only">Toggle sidebar</span>

					<span class="icon-bar"></span>

					<span class="icon-bar"></span>

					<span class="icon-bar"></span>
				</button>

				<!-- /section:basics/sidebar.mobile.toggle -->
				<div class="navbar-header pull-left">
					<!-- #section:basics/navbar.layout.brand -->
					<a href="#" class="navbar-brand">
						<small>
							<i class="fa fa-shopping-cart"></i>
							Slimfit Collection Kenya
						</small>
					</a>

					<!-- /section:basics/navbar.layout.brand -->

					<!-- #section:basics/navbar.toggle -->

					<!-- /section:basics/navbar.toggle -->
				</div>

				<!-- #section:basics/navbar.dropdown -->
				<div class="navbar-buttons navbar-header pull-right" role="navigation">
					<ul class="nav ace-nav">
						<li class="green">
							<a data-toggle="dropdown" class="dropdown-toggle" href="#">
								<i class="ace-icon fa fa-shopping-cart"></i>
								<span class="badge badge-yellow"><?php echo $user->countUnapprovedOrders(); ?></span>
							</a>
						</li>
						<!-- #section:basics/navbar.user_menu -->
						<li class="light-blue">
							<a data-toggle="dropdown" href="#" class="dropdown-toggle">
								<img class="nav-user-photo" src="../assets/avatars/avatar.png" alt="Jason's Photo" />
								<span class="user-info">
									<small>Welcome,</small>
									<?php echo $_SESSION["username"]; ?>
								</span>

								<i class="ace-icon fa fa-caret-down"></i>
							</a>

							<ul class="user-menu dropdown-menu-right dropdown-menu dropdown-yellow dropdown-caret dropdown-close">
								<li>
									<a href="../logout.php">
										<i class="ace-icon fa fa-power-off"></i>
										Logout
									</a>
								</li>
							</ul>
						</li>

						<!-- /section:basics/navbar.user_menu -->
					</ul>
				</div>

				<!-- /section:basics/navbar.dropdown -->
			</div><!-- /.navbar-container -->
		</div>

		<!-- /section:basics/navbar.layout -->
		<div class="main-container" id="main-container">
			<script type="text/javascript">
				try{ace.settings.check('main-container' , 'fixed')}catch(e){}
			</script>

			<!-- #section:basics/sidebar -->
			<div id="sidebar" class="sidebar                  responsive">
				<script type="text/javascript">
					try{ace.settings.check('sidebar' , 'fixed')}catch(e){}
				</script>

				<div class="sidebar-shortcuts" id="sidebar-shortcuts">
					<div class="sidebar-shortcuts-large" id="sidebar-shortcuts-large">
						<button class="btn btn-success">
							<i class="ace-icon fa fa-signal"></i>
						</button>

						<button class="btn btn-info">
							<i class="ace-icon fa fa-pencil"></i>
						</button>

						<!-- #section:basics/sidebar.layout.shortcuts -->
						<button class="btn btn-warning">
							<i class="ace-icon fa fa-users"></i>
						</button>

						<button class="btn btn-danger">
							<i class="ace-icon fa fa-cogs"></i>
						</button>

						<!-- /section:basics/sidebar.layout.shortcuts -->
					</div>

					<div class="sidebar-shortcuts-mini" id="sidebar-shortcuts-mini">
						<span class="btn btn-success"></span>

						<span class="btn btn-info"></span>

						<span class="btn btn-warning"></span>

						<span class="btn btn-danger"></span>
					</div>
				</div><!-- /.sidebar-shortcuts -->

				<ul class="nav nav-list">
					<li class="">
						<a href="index.php">
							<i class="menu-icon fa fa-tachometer"></i>
							<span class="menu-text"> Dashboard </span>
						</a>

						<b class="arrow"></b>
					</li>


					<li class="<?php if(isset($activeBrandsParent)){echo $activeBrandsParent;} ?>">
						<a href="#" class="dropdown-toggle">
							<i class="menu-icon fa fa-list"></i>
							<span class="menu-text"> Brands </span>

							<b class="arrow fa fa-angle-down"></b>
						</a>

						<b class="arrow"></b>

						<ul class="submenu">
							<li class="<?php if(isset($activeAddBrand)){echo $activeAddBrand;} ?>">
								<a href="add-brand.php">
									<i class="menu-icon fa fa-caret-right"></i>
									Add Brand
								</a>

								<b class="arrow"></b>
							</li>

							<li class="<?php if(isset($activeviewBrand)){echo $activeviewBrand;} ?>">
								<a href="view-brand.php">
									<i class="menu-icon fa fa-caret-right"></i>
									View Brands
								</a>

								<b class="arrow"></b>
							</li>
						</ul>
					</li>
          <li class="<?php if(isset($activeCategoryParent)){echo $activeCategoryParent;} ?>">
						<a href="#" class="dropdown-toggle">
							<i class="menu-icon fa fa-bars"></i>
							<span class="menu-text"> Categories </span>

							<b class="arrow fa fa-angle-down"></b>
						</a>

						<b class="arrow"></b>

						<ul class="submenu">
							<li class="<?php if(isset($activeAddCategory)){echo $activeAddCategory;} ?>">
								<a href="add-category.php">
									<i class="menu-icon fa fa-caret-right"></i>
									Add category
								</a>

								<b class="arrow"></b>
							</li>

							<li class="<?php if(isset($activeviewCat)){echo $activeviewCat;} ?>">
								<a href="view-category.php">
									<i class="menu-icon fa fa-caret-right"></i>
									View categories
								</a>

								<b class="arrow"></b>
							</li>
						</ul>
					</li>
          <li class="<?php if(isset($activeDeliveryParent)){echo $activeDeliveryParent;} ?>">
						<a href="#" class="dropdown-toggle">
							<i class="menu-icon fa fa-taxi"></i>
							<span class="menu-text"> Delivery Points </span>

							<b class="arrow fa fa-angle-down"></b>
						</a>

						<b class="arrow"></b>

						<ul class="submenu">
							<li class="<?php if(isset($activeAddDelivery)){echo $activeAddDelivery;} ?>">
								<a href="add-delivery.php">
									<i class="menu-icon fa fa-caret-right"></i>
									Add delivery point
								</a>

								<b class="arrow"></b>
							</li>

							<li class="<?php if(isset($activeviewDelivery)){echo $activeviewDelivery;} ?>">
								<a href="view-delivery.php">
									<i class="menu-icon fa fa-caret-right"></i>
									View delivery point
								</a>

								<b class="arrow"></b>
							</li>
						</ul>
					</li>
					<li class="<?php if(isset($activeProductsParent)){echo $activeProductsParent;} ?>">
						<a href="#" class="dropdown-toggle">
							<i class="menu-icon fa fa-shopping-cart"></i>
							<span class="menu-text"> Products </span>

							<b class="arrow fa fa-angle-down"></b>
						</a>

						<b class="arrow"></b>

						<ul class="submenu">
							<li class="<?php if(isset($activeAddProduct)){echo $activeAddProduct;} ?>">
								<a href="add-product.php">
									<i class="menu-icon fa fa-caret-right"></i>
									Add product
								</a>

								<b class="arrow"></b>
							</li>

							<li class="<?php if(isset($activeViewProduct)){echo $activeViewProduct;} ?>">
								<a href="view-product.php">
									<i class="menu-icon fa fa-caret-right"></i>
									View products
								</a>

								<b class="arrow"></b>
							</li>
						</ul>
					</li>
          <li class="<?php if(isset($activeOrdersParent)){echo $activeOrdersParent;} ?>">
						<a href="#" class="dropdown-toggle">
							<i class="menu-icon fa fa-newspaper-o"></i>
							<span class="menu-text"> Orders </span>

							<b class="arrow fa fa-angle-down"></b>
						</a>

						<b class="arrow"></b>

						<ul class="submenu">
							<li class="<?php if(isset($activeConfirmed)){echo $activeConfirmed;} ?>">
								<a href="confirmed-orders.php">
									<i class="menu-icon fa fa-caret-right"></i>
									Confirmed orders
								</a>

								<b class="arrow"></b>
							</li>

							<li class="<?php if(isset($activeUnConfirmed)){echo $activeUnConfirmed;} ?>">
								<a href="unconfirmed-orders.php">
									<i class="menu-icon fa fa-caret-right"></i>
									Unconfirmed orders
								</a>

								<b class="arrow"></b>
							</li>
						</ul>
					</li>
          <li class="<?php if(isset($activeUsers)){echo $activeUsers;} ?>">
						<a href="view-users.php">
							<i class="menu-icon fa fa-users"></i>
							<span class="menu-text"> Users </span>
						</a>

						<b class="arrow"></b>
					</li>
          <!-- <li class="">
						<a href="users.php">
							<i class="menu-icon fa fa-cog"></i>
							<span class="menu-text"> Settings </span>
						</a>

						<b class="arrow"></b>
					</li> -->
				</ul><!-- /.nav-list -->

				<!-- #section:basics/sidebar.layout.minimize -->
				<div class="sidebar-toggle sidebar-collapse" id="sidebar-collapse">
					<i class="ace-icon fa fa-angle-double-left" data-icon1="ace-icon fa fa-angle-double-left" data-icon2="ace-icon fa fa-angle-double-right"></i>
				</div>

				<!-- /section:basics/sidebar.layout.minimize -->
				<script type="text/javascript">
					try{ace.settings.check('sidebar' , 'collapsed')}catch(e){}
				</script>
			</div>
