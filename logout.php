<?php
//include config
require('func/config.php');

//log user out
$user->logout();
//header('Refresh: 0');
if(isset($_SERVER['HTTP_REFERER'])) {
  header('Location: '.$_SERVER['HTTP_REFERER']);
} else {
  header('Location: index.php');
}
exit;
?>
