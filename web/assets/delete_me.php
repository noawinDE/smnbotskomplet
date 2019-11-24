<?php
/**
 * Created by PhpStorm.
 * User: janni
 * Date: 20.01.2019
 * Time: 17:01
 */
require '../vendor/autoload.php';
\smnbots\Auth::getInstance()->requireLogin();
if (isset($_POST['method'])){
    if ($_POST['method'] == 'delete'){
        if (\smnbots\User::remove(\smnbots\Auth::getInstance()->getCurrentUser()->id)){
            echo "success";
        }
    }
}