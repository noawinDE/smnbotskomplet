<?php
/**
 * Created by PhpStorm.
 * User: janni
 * Date: 20.01.2019
 * Time: 17:01
 */
require '../vendor/autoload.php';
\smnbots\Auth::getInstance()->requireLogin();
if (isset($_POST['lang'])){
    if (\smnbots\translation::setLang($_POST['lang'])){
        echo "success";
    } else {
        echo "error";
    }
}