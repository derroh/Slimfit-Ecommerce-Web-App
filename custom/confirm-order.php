<?php
  require('../func/config.php');
  $CartId = $_REQUEST['OrderId'];
  $Status = 2;


    //alter product quantity
    //get order items and their quantities.. use loop
    $products_query = "select *
                        from `customer_orders` `customer_orders`
                       where
                             (`customer_orders`.`CartId` = '$CartId ')
                      ";
    $products = $user->fetch_products($products_query);



  foreach ($products as $item) {

    $ItemId = $item['ItemId'];

    $current_quantity = $user->getQuantity($item['ItemId']);

    $new_quantity = $current_quantity - $item['Quantity'];
          // update db
    $stmt2 = $db->prepare('UPDATE shop_items SET Quantity =:Quantity WHERE Id=:Id') ;
    $stmt2->execute(array( ':Quantity' => $new_quantity, ':Id' => $ItemId));

    if($stmt2)
    {
      $stmt = $db->prepare('UPDATE customer_orders SET Status =:Status WHERE CartId=:CartId') ;
      $stmt->execute(array(':Status' => $Status,':CartId' => $CartId ));
    }else {
            echo "failed";
    }
 }

  echo "Thank you! Your information was successfully updated!"; ?>
