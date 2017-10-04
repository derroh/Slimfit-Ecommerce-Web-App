<?php
	    $subtotal = $_GET['subtotal'];
			$shipping = $_GET['shippingcost'];

      $grandTotal = $shipping + $subtotal;

      echo $grandTotal;

?>
