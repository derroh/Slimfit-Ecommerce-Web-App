<?php
  require('../func/config.php');

  $DeliveryPointName = $_POST['DeliveryPointName'];
  $Amount = $_POST['Amount'];

    $stmt = $db->prepare('INSERT INTO deliverypoints (Name, Amount) VALUES (:Name, :Amount)') ;
    $stmt->execute(array(
     ':Name' => $DeliveryPointName,
     ':Amount' => $Amount
    ));

      echo "Thank you! Your information was successfully saved!";

  ?>
