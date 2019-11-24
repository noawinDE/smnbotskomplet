<?php
/**
 * Created by PhpStorm.
 * User: janni
 * Date: 20.01.2019
 * Time: 15:04
 */
require '../vendor/autoload.php';
\smnbots\Auth::getInstance()->requireAdmin();
if (isset($_POST['id'])){
    if (\smnbots\User::resetPassword($_POST['id'])){
        echo "success";
    } else {
        echo "error";
    }

}