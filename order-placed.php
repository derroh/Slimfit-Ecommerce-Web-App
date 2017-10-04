<?php

require('func/config.php');

if(!$user->is_logged_in()){ header('Location: login.php'); }

include('includes/front/header.php');?>

<section id="cart_items">
    <div class="container">
      <div class="breadcrumbs">
				<ol class="breadcrumb">
				  <li><a href="#">Home</a></li>
				  <li class="active">Order Placed</li>
				</ol>
			</div>
        <div class="row">

          <?php include('includes/front/sidebar.php');?>

            <div class="col-sm-9 padding-right">
                <H2>Your oder has been placed succesfully!<H2>
            </div>
        </div>
    </div>
</section>

<?php include('includes/front/footer.php');?>
