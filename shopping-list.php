<?php

require('func/config.php');

if(!$user->is_logged_in()){ header('Location: login.php'); }

include('includes/front/header.php');?>

<section id="cart_items">
    <div class="container">
      <div class="breadcrumbs">
				<ol class="breadcrumb">
				  <li><a href="#">Home</a></li>
				  <li class="active">Shopping List</li>
				</ol>
			</div>
        <div class="row">

          <?php include('includes/front/sidebar.php');?>

            <div class="col-sm-9 padding-right">
                <div class="table-responsive cart_info">
                    <table class="table table-condensed">
                        <thead>
                        <tr class="cart_menu">
                            <td class="image">Item</td>
                            <td class="description"></td>
                            <td class="price">Cart Id</td>
                            <td class="price">Price</td>
                            <td class="quantity">Quantity</td>
                            <td class="total">Total</td>
                            <td class="delivery">Status</td>

                        </tr>
                        </thead>
                        <tbody>
                          <?php
                            $userId = $_SESSION["uid"];
                            $query = "select * from customer_orders where CustomerId = $userId ORDER BY Id DESC";
                            $products = $user->fetch_products($query);
                          ?>

                        <!-- show product in cart -->
                        <?php if ( empty($products) ): ?>
                            <tr>
                                <td colspan="20"> <h4>Your Shopping List Is Empty</h4> </td>
                            </tr>
                        <?php else: ?>
                            <?php foreach ($products as $item) :?>

                            <tr>
                                <td class="cart_product">
                                    <a href=""><img style="width: 70px; height: 80px" alt="" src="<?php echo $item['Image']?>"></a>
                                </td>
                                <td class="cart_description">
                                    <h4><?php echo $item['Name']?></h4>
                                    <p>ID: <?php echo $item['ItemId']?> </p>
                                </td>
                                <td class="cart_price">
                                    <p>Ksh <?php echo $item['CartId']?></p>
                                </td>
                                <td class="cart_price">
                                    <p>Ksh <?php echo $item['Price']?></p>
                                </td>
                                <td class="cart_quantity">
                                    <div class="cart_quantity_button">
                                    <p><?php echo $item['Quantity']?></p>
                                    </div>
                                </td>
                                <td class="cart_total">
                                    <p class="cart_total_price">Ksh <?php echo $item['Total'] ?></p>
                                </td>
                                <td class="cart_total">
                                    <p>  <?php if($item['Status']=="1"){echo "Order Placed";}else if($item['Status']=="2"){echo "On transit";} else if($item['Status']=="3"){echo "Delivered";} ?></p>
                                </td>

                            </tr>

                            <?php endforeach; ?>


                        <?php endif;?>
                        </tbody>
                    </table>


                </div>
            </div>
        </div>
    </div>
</section>

<?php include('includes/front/footer.php');?>
