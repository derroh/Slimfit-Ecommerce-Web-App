<?php
  require('../func/config.php');
  $CategoryName = $_POST['CategoryName'];
  $Id = $_POST['Id'];

    $stmt = $db->prepare('UPDATE categories SET Name =:Name WHERE Id=:Id') ;
    $stmt->execute(array(
     ':Name' => $CategoryName,
      ':Id' => $Id
    ));

      echo "Thank you! Your information was successfully updated!";

  ?>
