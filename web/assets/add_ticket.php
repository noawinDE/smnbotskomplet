<?php
require '../vendor/autoload.php';
\smnbots\Auth::getInstance()->requireLogin();
if (isset($_POST['message'])){
    if (\smnbots\ticket::addAnswer(nl2br($_POST['message']),$_POST['ticket_id'])){
        echo "success";
    } else {
        echo "false";
    }
}