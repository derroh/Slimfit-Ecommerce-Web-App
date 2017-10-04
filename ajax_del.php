<?php
/**
 * Created by PhpStorm.
 * User: quyentv
 * Date: 3/19/2015
 * Time: 3:56 PM
 */
session_start();

$id = $_REQUEST['post_id'];

//check session
if (isset($_SESSION['cart_info'][$id])) {
    unset($_SESSION['cart_info'][$id]); // del secssion
}

// i need set cookie by javascript
if (isset($_COOKIE['sids'])) {
    $sids = $_COOKIE['sids'];

    $fromidscookie = explode(',',$sids);
    $newids = [];
    foreach ($fromidscookie as $val) {
        if (trim($val) == trim($id)) {
            continue;
        }
        $newids[] = $val;
    }

    $result['code'] = 99;
    $result['ms'] = 'Oke';
    $result['sids'] = implode(',',$newids);
    echo json_encode($result);
    die;
}





$result['code'] = -1;
$result['ms'] = 'Not exist :(';
echo json_encode($result);
die;