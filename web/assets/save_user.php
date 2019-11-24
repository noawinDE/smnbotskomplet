<?php
require '../vendor/autoload.php';
\smnbots\Auth::getInstance()->requireAdmin();
if (isset($_POST['uid'],$_POST['name'],$_POST['maxbots'])){
    if (\smnbots\User::updateUser($_POST['uid'],$_POST['name'],$_POST['maxbots'],$_POST['email'])){
        echo "success";
    } else {
        echo "error";
    }
}