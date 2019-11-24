<?php
require '../vendor/autoload.php';
\smnbots\Auth::getInstance()->requireAdmin();
if(\smnbots\changelog::createChangelog($_POST['name'],nl2br($_POST['message']))){
    echo "success";
} else {
    echo "error";
}