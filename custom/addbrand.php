<?php
  require('../func/config.php');
  $BrandName = $_POST['BrandName'];

    $stmt = $db->prepare('INSERT INTO brands (Name) VALUES (:Name)') ;
    $stmt->execute(array(
     ':Name' => $BrandName
    ));

      echo "Thank you! Your information was successfully saved!";

  ?>
