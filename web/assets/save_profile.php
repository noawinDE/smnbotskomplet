<?php
require '../vendor/autoload.php';
\smnbots\Auth::getInstance()->requireLogin();
if (isset($_POST['method'])){
    switch ($_POST['method']){
        case "password":
            if ($_POST['password'] === $_POST['password_repeat']){
                if(\smnbots\User::changePassword($_POST['password'])){
                    echo "success";
                } else {
                    echo "error";
                }
            } else {
                echo "nomatch";
            }
            break;
        case "adress":
            if (isset($_POST['street'],$_POST['street_number'],$_POST['zip'],$_POST['city'],$_POST['country'])){
                if(\smnbots\User::saveAdress($_POST['street'],$_POST['street_number'],$_POST['zip'],$_POST['city'],$_POST['country'])){
                    echo "success";
                } else {
                    echo "error";
                }
            } else {
                echo "error";
            }
            break;
        default:
            echo "error";
            break;
    }

}
