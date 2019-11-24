<?php
/**
 * Created by PhpStorm.
 * User: janni
 * Date: 20.01.2019
 * Time: 15:04
 */
require '../vendor/autoload.php';
if (isset($_POST['tid'])){
    $ticket = \smnbots\ticket::getTicket($_POST['tid']);
    if ($ticket !== false){
        if (\smnbots\ticket::setStatus($_POST['tid'],3)){
            echo "success";
        } else {
            echo "error";
        }
    } else {
        echo "error";
    }
}