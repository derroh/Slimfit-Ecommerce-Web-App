<?php
  require('../func/config.php');

  $DeliveryPointName = $_POST['DeliveryPointName'];
  $Amount = $_POST['Amount'];
  $Id = $_POST['Id'];

    $stmt = $db->prepare('UPDATE deliverypoints SET Name =:Name, Amount =:Amount WHERE Id=:Id') ;
    $stmt->execute(array(
     ':Name' => $DeliveryPointName,
     ':Amount' => $Amount,
      ':Id' => $Id
    ));

      echo "Thank you! Your information was successfully updated!";

  ?>
