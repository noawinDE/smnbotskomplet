<?php
require '../vendor/autoload.php';
\smnbots\Auth::getInstance()->requireLogin();
$user_ip = (isset($_SERVER["HTTP_CF_CONNECTING_IP"])?$_SERVER["HTTP_CF_CONNECTING_IP"]:$_SERVER['REMOTE_ADDR']);
error_log('CREATE_BOT: '.$user_ip);
if (isset($_POST['nickname'],$_POST['server'],$_POST['rand_node_id'])&&strlen($_POST['nickname'])>2&&strlen($_POST['nickname'])<28){
    $user = \smnbots\Auth::getInstance()->getCurrentUser();
    $name = $_POST['nickname'];
    $name = strip_tags($name);
	$random_node_id = intval($_POST['rand_node_id']);
	
    function getNode(){
        $nodelist = \smnbots\Bot::countNodes()[2];
        if (in_array($nodelist,\smnbots\Config::PRIV_NODES)){
            return randomNode($random_node_id);
        } else {
            $cnf = \smnbots\Config::nodes;
            if (!empty($cnf[$nodelist])){
                return (int)$nodelist;
            } else {
                return randomNode($random_node_id);
            }
        }
    }
	
    function randomNode($random_node_id){
        $privnodes = \smnbots\Config::PRIV_NODES;
        $nodes = \smnbots\Config::nodes;
        foreach ($privnodes as $privnode){
            unset($nodes[$privnode]);
        }
        if (empty($nodes)){
            return 1;
        }
        $rand_keys = array_rand($nodes, 1);
        //return $rand_keys;
		return $random_node_id;
    }
	
    if ($user->force_node !== NULL){
        $cnf = \smnbots\Config::nodes;
        $newnode = $user->force_node;
        if (!empty($cnf[$newnode])){
            $newnode = randomNode($random_node_id);
        } else {
            $newnode = randomNode($random_node_id);
        }
    } else {
        $newnode = randomNode($random_node_id);
    }
    $bot = new smnbots\Bot($newnode);
    if (!\smnbots\Auth::getInstance()->isAdmin()) {
        if ($bot->countBots($user->id) < $user->max_bots || $user->max_bots == -1) {
            $create = true;
            // erstellen möglich
        } else {
            $create = false;
            // erstellen unmöglich
        }
    } else {
        $create = true;
    }
    if ($create){
        $nickname = $name;
        if( isset($_POST['name'])){
            if ($_POST['name'] !== ""){
                $nickname = $_POST['name'];
            }
        }
        if ($bot->createbot($name,$_POST['server'],$nickname)){
            echo "success";
        } else {
            echo "false";
        }
    } else {
        echo "false";
    }
}