<?php
  require('../func/config.php');
  $BrandName = $_POST['BrandName'];
  $Id = $_POST['Id'];

    $stmt = $db->prepare('UPDATE brands SET Name =:Name WHERE Id=:Id') ;
    $stmt->execute(array(
     ':Name' => $BrandName,
      ':Id' => $Id
    ));

      echo "Thank you! Your information was successfully updated!";

  ?>
