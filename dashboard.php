<?php

  require('func/config.php');

  if(!$user->is_logged_in())
  {
     header('Location: login');

  } else if($user->is_logged_in()){

    //give access levels

    if($_SESSION["Role"] =="1"){
      header('Location: admin/index');
    }else if($_SESSION["Role"] =="2"){
      header('Location: admin/index');
    }
  }

?>
