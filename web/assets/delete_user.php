<?php
require '../vendor/autoload.php';
\smnbots\Auth::getInstance()->requireAdmin();
if (isset($_POST['userid'])){
    if (\smnbots\User::remove($_POST['userid'])){
        echo "success";
    } else {
        echo "false";
    }
}