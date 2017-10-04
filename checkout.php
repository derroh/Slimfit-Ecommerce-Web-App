<?php
require('func/config.php');

if(!$user->is_logged_in()){ header('Location: login.php'); }

if(isset($_GET['destination'])){
  $_SESSION['Destination'] = $_GET['destination'];
}

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
                          <td>Delivery point</td>
                          <td>
                            <form action="" method="get">
                              <?php
                                $destination_query = "select * from deliverypoints ";
                                $destination = $user->fetch_products($destination_query);
                               ?>
                            <select class="chosen-select form-control" name="destination" id="destination" data-placeholder="Date"  onchange="this.form.submit()">
                              <option value="0">  </option>
                              <?php foreach ($destination as $item) :?>
                                <option value="<?php echo $item['Id'];?>" <?php if(isset($_GET['destination'])){if($item['Id']==$_GET['destination']){echo "selected = 'true'";}} ?>> <?php echo $item['Name'];?> </option>
                              <?php endforeach; ?>
                            </select>
                          </form>
                          </td>
                        </tr>
                        <tr>
                          <td>Delivery Cost</td>
                          <td><span id="payment-total">Ksh <?php if(isset($_GET['destination'])){ echo $user->destinationAmount($_GET['destination']);}else {
                            echo "0";
                          } ?></span></td>
                        </tr>

                        <tr>
                          <td>Total</td>
                          <td><span id="payment-total">Ksh <?php if(isset($_GET['destination'])){echo $payment_total+$user->destinationAmount($_GET['destination']);}else {
                            echo $payment_total;
                          } ?></span></td>
                        </tr>
                        <tr>
                          <form class="" action="order.php" method="post">
                            <td>
                              <?php if ( isset($_GET['destination']) ): ?>
                                <button type="submit" class="btn btn-default check_out pull-right" >Check Out</button></td>
                              <?php else: ?>
                                <td><div class="col-sm-12">
                                    <div class="alert alert-danger">
                                      <span class="glyphicon glyphicon-info-sign"></span> &nbsp; You have not selected a delivery point for your goods..
                                    </div>
                                </div></td>

                                <?php endif;?>
                          </form>

                        </tr>

                    </table>
                  </td>
                </tr>
						<?php endif;?>
					</tbody>
				</table>
			</div>
			<div class="payment-options">
					<span>
						<label><input type="checkbox"> Direct Bank Transfer</label>
					</span>
					<span>
						<label><input type="checkbox"> Check Payment</label>
					</span>
					<span>
						<label><input type="checkbox"> Paypal</label>
					</span>
				</div>
		</div>
	</section> <!--/#cart_items-->

<?php include('includes/front/footer.php');?>
