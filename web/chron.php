<?php /* require 'vendor/autoload.php';
$bot = new \smnbots\Bot(0);
$dbbots = $bot->botlist();
$botlist = \smnbots\Bot::botTemplateList();
/*foreach (\smnbots\Config::nodes as $key => $node) {
    $cnode = new \smnbots\ts3ab\Ts3AudioBot($node['host'],$node['port']);
    $cnode->basicAuth($node['key']);
    if ($cnode->rawRequest('bot/info') == false){
        \smnbots\Bot::setNodeStatus($key,false);
	\smnbots\Mail::send('Simon Daum','node-notify@smndm.de','Ausfall von NODE-'.$key,'<h1>SYSTEM-MESSAGE</h1><br><br>Sehr geehrter Herr Daum, <br> Die NODE: <strong>SMN-'.$key.'</strong> kann vom System nichtmehr erreicht werden. Butte überprüfen sie den Status der Node. <br><br>SMNBOTS.NET');
    } else {
        \smnbots\Bot::setNodeStatus($key,true);
    }
}*/
foreach ($dbbots as $bots){
    if($bots['is_online'] == 1){
        $dbonline = true;
    } else {
        $dbonline = false;
    }
    $online = $bot->botOnline($bots['template'],$botlist);
    if ($dbonline !== $online){
        if ($online){
            $bot->setBotOnline($bots['id']);
        } else {
            $bot->setBotOffline($bots['id']);
        }
    }
} */
?>