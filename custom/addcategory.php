<?php
  require('../func/config.php');
  $CategoryName = $_POST['CategoryName'];

    $stmt = $db->prepare('INSERT INTO categories (Name) VALUES (:Name)') ;
    $stmt->execute(array(
     ':Name' => $CategoryName
    ));

      echo "Thank you! Your information was successfully saved!";

  ?>
