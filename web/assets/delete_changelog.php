<?php
/**
 * Created by PhpStorm.
 * User: janni
 * Date: 03.02.2019
 * Time: 16:52
 */
require '../vendor/autoload.php';
\smnbots\Auth::getInstance()->requireAdmin();
if(\smnbots\changelog::deleteChangelog($_POST['id'])){
    echo "success";
} else {
    echo "error";
}