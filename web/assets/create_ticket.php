<?php
/**
 * Created by PhpStorm.
 * User: janni
 * Date: 20.01.2019
 * Time: 01:23
 */
require '../vendor/autoload.php';
use smnbots\Auth;
use smnbots\ticket;
if (isset($_POST['title'],$_POST['message'],$_POST['botid'],$_POST['category'])){
	$user = Auth::getInstance()->getCurrentUser();
	$limit = ticket::getCount($user->id);
	if($limit <= 4){
		if (\smnbots\ticket::createTicket($_POST['title'],nl2br($_POST['message']),$_POST['botid'],$_POST['category'])){
        	echo "success";
    	} else {
        	echo "error";
    	}
	} else {
		$user_ip = (isset($_SERVER["HTTP_CF_CONNECTING_IP"])?$_SERVER["HTTP_CF_CONNECTING_IP"]:$_SERVER['REMOTE_ADDR']);
		error_log('T_MAX: '.$user_ip);
	}
}