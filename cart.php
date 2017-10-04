<?php

require('func/config.php');


// check cookie exist
if ( isset( $_COOKIE['sids']) &&  $_COOKIE['sids'] !='') {
    $aids = explode(',',$_COOKIE['sids']) ;

    // validate data
    foreach ($aids as $k => $val) {
        if (!is_numeric($val)) {
            unset($aids[$k]);
        }
    }

    $products = $user->getListProductByListIds($aids);


    // init session from cookie.
    foreach ($products as $item) {
        if (!isset($_SESSION['cart_info'][$item['id']]) ) {
            $temp = [];

            $temp['id'] = $item['id'];
            $temp['name'] = $item['name'];
            $temp['cost'] = $item['cost'];
            $temp['image'] = $item['image'];
            $temp['quantity'] = 1;  // default

            $_SESSION['cart_info'][$item['id']] = $temp;
        }
    }
}


include('includes/front/header.php');?>

<section id="cart_items">
    <div class="container">
      <div class="breadcrumbs">
				<ol class="breadcrumb">
				  <li><a href="#">Home</a></li>
				  <li class="active">Shopping Cart</li>
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
                            <td class="price">Price</td>
                            <td class="quantity">Quantity</td>
                            <td class="total">Total</td>
                            <td></td>
                        </tr>
                        </thead>
                        <tbody>

                        <!-- show product in cart -->
                        <?php if ( !isset($_SESSION['cart_info'])  || empty($_SESSION['cart_info']) ): ?>
                            <tr>
                                <td colspan="20"> <h4>Your Shopping Cart Is Empty</h4> </td>
                            </tr>
                        <?php else: ?>
                            <?php $payment_total = 0;?>
                            <?php foreach($_SESSION['cart_info'] as $item): ?>

                            <tr>
                                <td class="cart_product">
                                    <a href=""><img style="width: 70px; height: 80px" alt="" src="<?php echo $item['image']?>"></a>
                                </td>
                                <td class="cart_description">
                                    <h4><a href=""><?php echo $item['name']?></a></h4>
                                    <p>ID: <?php echo $item['id']?> </p>
                                </td>
                                <td class="cart_price">
                                    <p>Ksh <?php echo $item['cost']?></p>
                                </td>
                                <td class="cart_quantity">
                                    <div class="cart_quantity_button">
                                        <?php echo $user->dropdown_select('quantity', $item['quantity'], $item['id'], $item['id'] );?>

                                    </div>
                                </td>
                                <td class="cart_total">
                                    <p id="total-item-<?php echo $item['id']?>" class="cart_total_price">Ksh <?php echo $item['cost'] * $item['quantity'];?></p>
                                </td>
                                <td class="cart_delete">
                                    <a href="javascript:void(0);" ref="<?php echo $item['id']?>" class="cart_quantity_delete"><i class="fa fa-times"></i></a>
                                </td>
                            </tr>
                                <?php  $payment_total += $item['cost'] * $item['quantity']; ?>

                            <?php endforeach; ?>

                            <tr>
                							<td colspan="4">&nbsp;</td>
                							<td colspan="2">
                								<table class="table table-condensed total-result">
                									<tr>
                										<td>Cart Sub Total</td>
                										<td>Ksh <?php echo $payment_total; ?></td>
                									</tr>

                									<tr>
                										<td>Total</td>
                										<td><span id="payment-total">Ksh <?php echo $payment_total; ?></span></td>
                									</tr>
                                  <tr>
                										<td>
                                      <form class="" action="checkout.php" method="post">
                                           <button type="submit" class="btn btn-default check_out pull-right" >Check Out</button></td>
                                      </form>

                									</tr>
                								</table>
                							</td>
                						</tr>
                        <?php endif;?>
                        </tbody>
                    </table>


                </div>
            </div>
        </div>
    </div>
</section>

<?php include('includes/front/footer.php');?>
