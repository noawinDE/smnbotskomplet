<?php
require '../vendor/autoload.php';
\smnbots\Auth::getInstance()->requireAdmin();
if (isset($_POST['name'],$_POST['email'])){
    if (\smnbots\User::signup($_POST['name'],$_POST['email'])){
        echo "success";
    } else {
        echo "false";
    }
}