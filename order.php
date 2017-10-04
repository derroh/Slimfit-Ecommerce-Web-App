<?php
//get cart items
if(isset($_SESSION['Destination'])){

  header('Location: checkout.php?err=1');

}else {
  # code...

//store cart items to orders table

  require('func/config.php');
  //if not logged in redirect to login page
  if(!$user->is_logged_in()){ header('Location: login.php'); }

  $CustomerId = $_SESSION["uid"];

  $Destination = $_SESSION['Destination'];

  //
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
  //get items in cart_info
  if ( !isset($_SESSION['cart_info'])  || empty($_SESSION['cart_info']) ){
    header('Location: '.$_SERVER['HTTP_REFERER']);
  }else {
    # code...

    foreach($_SESSION['cart_info'] as $item){

      $ItemId = $item['id'];
      $ItemName = $item['name'];
      $ItemImage = $item['image'];
      $Price = $item['cost'];
      $Quantity = $item['quantity'];
      $Total = $item['cost'] * $item['quantity'];
      $DateAdded = date('Y-m-d H:i:s');//year-month-day-hour-minutes-seconds
      $cartid = date('YmdHi') . $_SESSION['uid'];
      $status = 1;
      //save to table
      $stmt = $db->prepare('INSERT INTO customer_orders(CartId, ItemId, Name, Image, Price, Quantity, Total, DatePlaced, CustomerId, Destination, Status) VALUES (:CartId,:ItemId, :Name, :Image, :Price, :Quantity, :Total, :DatePlaced, :CustomerId, :Destination, :Status)') ;
      $stmt->bindParam(':CartId',$cartid);
      $stmt->bindParam(':ItemId',$ItemId);
      $stmt->bindParam(':Name',$ItemName);
      $stmt->bindParam(':Image',$ItemImage);
      $stmt->bindParam(':Price',$Price);
      $stmt->bindParam(':Quantity',$Quantity);
      $stmt->bindParam(':Total',$Total);
      $stmt->bindParam(':DatePlaced',$DateAdded);
      $stmt->bindParam(':CustomerId',$CustomerId);
      $stmt->bindParam(':Destination',$Destination);
      $stmt->bindParam(':Status',$status);
      $stmt->execute();

      //orders table

      $deliveryCost = $user->destinationAmount($Destination);
      $stmt2 = $db->prepare('INSERT INTO deliverycarts(CartId, DeliveryCost) VALUES (:CartId, :DeliveryCost)') ;
      $stmt2->bindParam(':CartId',$cartid);
      $stmt2->bindParam(':DeliveryCost',$deliveryCost);
      $stmt2->execute();



    }

    unset($_SESSION['cart_info']);

    header('Location: order-placed.php');

  }

}
  ?>
