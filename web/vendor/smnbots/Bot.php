<?php

namespace smnbots;

use PDOException;
use smnbots\ts3ab\Ts3AudioBot;

class Bot
{
    private $_botconn;
    private $_dbconn;

    /**
     * Bot constructor.
     * @param int $node
     */
    public function __construct($node = 1) {
        if($node == 0){
            $this->_dbconn = Database::getDB();
        } else {
            $config = Config::nodes;
            if (empty($config)){
                $config = Config::nodes[1];
            }
		
            $config = $config[$node];
            $this->_node = $node;
            $this->_botconn = new Ts3AudioBot($config['host'],$config['port']);
            $this->_botconn->basicAuth($config['key']);
            $this->_dbconn = Database::getDB();
        }
    }

    public function listbots() {
        return $this->_botconn->getCommandExecutor()->listBots();
    }


    /**
     * Return list of all Bots
     *
     * @return array
     */
    public function botlist(){
        try {
            $sql = 'SELECT * FROM `bots` ORDER BY id ASC';
            $stmt = $this->_dbconn->prepare($sql);
            $stmt->execute();

            return $stmt->fetchAll();
        } catch (PDOException $e) {
            error_log($e->getMessage());
            return array();
        }
    }

    public function groupNodes(){
        try {
            $sql = 'SELECT node FROM `bots` GROUP BY node';
            $stmt = $this->_dbconn->prepare($sql);
            $stmt->execute();

            return $stmt->fetchAll();
        } catch (PDOException $e) {
            error_log($e->getMessage());
            return array();
        }
    }

    public function adminBots(){
        $adminlist = join("','",$this->getAdminids());
        try {
            $sql = "SELECT * FROM `bots` WHERE `owner` IN ('".$adminlist."')";
            $stmt = $this->_dbconn->prepare($sql);
            $stmt->execute();

            return $stmt->fetchAll();
        } catch (PDOException $e) {
            error_log($e->getMessage());
            return array();
        }
    }

    public function getAdminids(){
        try {
            $sql = 'SELECT `id` FROM `users` WHERE `is_admin` = 1';
            $stmt = $this->_dbconn->prepare($sql);
            $stmt->execute();
            $ids = array();
            foreach ($stmt->fetchAll() as $admin){
                $ids[] = $admin['id'];
            }
            return $ids;
        } catch (PDOException $e) {
            error_log($e->getMessage());
            return array();
        }
    }

    public function memberBots(){
        $memberlist = join("','",$this->getMemberids());
        try {
            $sql = "SELECT * FROM `bots` WHERE `owner` IN ('".$memberlist."')";
            $stmt = $this->_dbconn->prepare($sql);
            $stmt->execute();

            return $stmt->fetchAll();
        } catch (PDOException $e) {
            error_log($e->getMessage());
            return array();
        }
    }

    public function getMemberids(){
        try {
            $sql = 'SELECT `id` FROM `users` WHERE `is_admin` = 0';
            $stmt = $this->_dbconn->prepare($sql);
            $stmt->execute();

            foreach ($stmt->fetchAll() as $member){
                $ids[] = $member['id'];
            }
            return $ids;
        } catch (PDOException $e) {
            error_log($e->getMessage());
            return array();
        }
    }

    /**
     * Return list of Bots owned by $oid
     *
     * @param $oid int OwnerID
     * @return array
     */
    public function userbotlist($oid){
        try {
            $sql = 'SELECT * FROM `bots` WHERE `owner` = :owner';
            $stmt = $this->_dbconn->prepare($sql);
            $stmt->execute(array('owner' => $oid));

            return $stmt->fetchAll();
        } catch (PDOException $e) {
            error_log($e->getMessage());
            return array();
        }
    }

    /**
     * Coint Bots owned by $oid
     *
     * @param $oid int OwnerID
     * @return array
     */
    public function countBots($oid){
        try {
            $sql = 'SELECT COUNT(*) as total FROM `bots` WHERE `owner` = :owner';
            $stmt = $this->_dbconn->prepare($sql);
            $stmt->execute(array('owner' => $oid));

            return $stmt->fetch()['total'];
        } catch (PDOException $e) {
            error_log($e->getMessage());
            return array();
        }
    }

    /**
     * Create Bot
     *
     * @param $nickname string Bot name
     * @param $ip string IP Adress
     * @return bool true if Bot created false if creation fails
     */
    public function createbot($nickname,$ip,$name){
        $bot = $this->_botconn;
        $id = Auth::getInstance()->getCurrentUser()->id;
        $template = $id.'-'.$this->_node.'-'.time().'-'.self::generateRandomString(6);
        $new_bot = $bot->getCommandExecutor()->connectNew($ip);
        if (isset($new_bot['ErrorName']) || empty($new_bot['Id'])){
            return false;
        }
        $bot->getCommandExecutor()->use($new_bot['Id']);
        sleep(1);
        $bot->getCommandExecutor()->name($nickname);
        sleep(0.5);
        $bot->getCommandExecutor()->save($template);
        $bot->getCommandExecutor()->setBotSettings($template,'connect.name',$nickname);
        try {
            $sql = "INSERT INTO `bots` (`id`, `name`, `interface_name`, `template`, `server`, `node`, `botid`, `owner`,`is_online`) VALUES (NULL, :name, :interface_name, :template, :server, :node, :botid, :owner,'1')";
            $stmt = $this->_dbconn->prepare($sql);
            $stmt->execute(array(
                'name' => $nickname,
                'interface_name' => $name,
                'template' => $template,
                'server' => $ip,
                'node'  => $this->_node,
                'botid' => $new_bot['Id'],
                'owner' => $id
            ));
            if ($stmt->rowCount() == 1) {
                return true;
            }
        } catch (PDOException $e) {
            error_log($e->getMessage());
        }
        return false;
    }

    /**
     * Start already Created Bot
     *
     * @param $id int DatabaseID
     * @return bool true if Bot is Online false if starting fails
     */
    public function startBot($id){
        $bot = $this->getById($id);
        if (empty($bot)){
            return false;
        }
        try {
            $botc = $this->_botconn;
            $this->_botconn->getCommandExecutor()->setBotSettings($bot['template'],'connect.channel',$bot['default_channel']);
            $newid = $botc->getCommandExecutor()->connectTo($bot['template']);
            sleep(2);
            $newid = $newid['Id'];
            if($newid == null){
                error_log('SIMON STARTE DEN DEFAULT BOT VON NODE-'.$bot['node']);
                return false;
            }
            $sql = "UPDATE `bots` SET `is_online` = '1' WHERE `id` = :id;";
            $stmt = $this->_dbconn->prepare($sql);
            $stmt->execute(array('id' => $id));
            self::updateBId($newid,$bot['template']);
            $botc->getCommandExecutor()->use($newid);
            $botc->getCommandExecutor()->volume($bot['audio.volume']);
            $botc->getCommandExecutor()->play($bot['audio.stream']);
            $botc->getCommandExecutor()->name($bot['name']);
            if ($bot['channel_commander']){
                $botc->getCommandExecutor()->makeCommander();
            }
            return true;
        } catch (PDOException $e) {
            error_log($e->getMessage());
            return false;
        }
    }

    /**
     * Toggle ChannelCommander
     *
     * @param $id int BotDatabaseID
     * @param $cm bool true to activate ccm false to deactivate
     * @return bool true if bot can get ccm false if fails or permission missing
     */
    public function setCCM($id,$cm){
        $bot = $this->getById($id);
        if (empty($bot)){
            return false;
        }
        if ($bot['channel_commander'] == $cm){
            return true;
        }
        $botc = $this->_botconn;
        $botc->getCommandExecutor()->use($bot['botid']);
        if ($cm){
            $ret = $botc->getCommandExecutor()->makeCommander();
        } else {
            $ret = $botc->getCommandExecutor()->takeCommander();
        }
        if ($ret == NULL){
            try {
                $sql = "UPDATE `bots` SET `channel_commander` = :ccm WHERE `id` = :id;";
                $stmt = $this->_dbconn->prepare($sql);
                $stmt->execute(array('id' => $id,'ccm' => $cm));
                return true;
            } catch (PDOException $e) {
                error_log($e->getMessage());
            }
        }
        return false;
    }

    public function stopBot($id){
        $bot = $this->getById($id);
        if (empty($bot)){
            return false;
        }
        try {
            $sql = "UPDATE `bots` SET `is_online` = '0' WHERE `id` = :id;";
            $stmt = $this->_dbconn->prepare($sql);
            $stmt->execute(array('id' => $id));
            $botc = $this->_botconn;
            $botc->getCommandExecutor()->use($bot['botid']);
            $botc->getCommandExecutor()->disconnect();
            return true;
        } catch (PDOException $e) {
            error_log($e->getMessage());
            return false;
        }
    }

    public function changeNickname($id,$name){
        if (strlen($name) > 30){
            return false;
        }
        $bot = $this->getById($id);
        if (empty($bot)){
            return false;
        }
        $name = strip_tags($name);
        try {
            $sql = 'UPDATE `bots` SET `name` = :name WHERE `id` = :id;';
            $stmt = $this->_dbconn->prepare($sql);
            $stmt->execute(array('id' => $id,'name' => $name));
            $botc = $this->_botconn;
            $botc->getCommandExecutor()->setBotSettings($bot['template'],'connect.name',$name);
            if ($bot['botid'] !== NULL){
                $botc->getCommandExecutor()->use($bot['botid']);
                $botc->getCommandExecutor()->name($name);
            }
            return true;
        } catch (PDOException $e) {
            error_log($e->getMessage());
            return false;
        }
    }

    public function setVolume($id,$volume){
        $bot = $this->getById($id);
        if (empty($bot)){
            return false;
        }
        if ($volume == $bot['audio.volume']){
            return true;
        }
        try {
            $sql = 'UPDATE `bots` SET `audio.volume` = :volume WHERE `id` = :id;';
            $stmt = $this->_dbconn->prepare($sql);
            $stmt->execute(array('id' => $id,'volume' => $volume));
            $botc = $this->_botconn;
            $botc->getCommandExecutor()->use($bot['botid']);
            $botc->getCommandExecutor()->volume((int)$volume);
            return true;
        } catch (PDOException $e) {
            error_log($e->getMessage());
            return false;
        }
    }

    public function changeServer($id,$server){
        $bot = $this->getById($id);
        if (empty($bot)){
            return false;
        }
        try {
            $sql = 'UPDATE `bots` SET `server` = :server WHERE `id` = :id;';
            $stmt = $this->_dbconn->prepare($sql);
            $stmt->execute(array('id' => $id,'server' => $server));
            $this->_botconn->getCommandExecutor()->setBotSettings($bot['template'],'connect.address',$server);
            return true;
        } catch (PDOException $e) {
            error_log($e->getMessage());
            return false;
        }
    }

    public function playURL($id,$url,$old){
        $bot = $this->getById($id);
        if (empty($bot)){
            return false;
        }
        if ($url == $old){
            return true;
        }
        try {
            $sql = 'UPDATE `bots` SET `audio.stream` = :stream WHERE `id` = :id;';
            $stmt = $this->_dbconn->prepare($sql);
            $stmt->execute(array('id' => $id,'stream' => $url));
            $botc = $this->_botconn;
            $botc->getCommandExecutor()->setBotSettings($bot['template'],'events.onconnect',"!play ".$url);
            $botc->getCommandExecutor()->setBotSettings($bot['template'],'events.onidle',"!play ".$url);
            if ($bot['botid'] !== NULL){
                $botc->getCommandExecutor()->use($bot['botid']);
                $botc->getCommandExecutor()->play($url);
            }
            return true;
        } catch (PDOException $e) {
            error_log($e->getMessage());
            return false;
        }
    }

    public static function generateRandomString($length = 10) {
        $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $charactersLength = strlen($characters);
        $randomString = '';
        for ($i = 0; $i < $length; $i++) {
            $randomString .= $characters[rand(0, $charactersLength - 1)];
        }
        return $randomString;
    }

    public function getByTemplate($template){
        try {
            $sql = 'SELECT * FROM `bots` WHERE template = :template LIMIT 1';
            $stmt = $this->_dbconn->prepare($sql);
            $stmt->execute(array('template' => $template));
            return $stmt->fetch();
        } catch (PDOException $e) {
            error_log($e->getMessage());
            return array();
        }
    }

    public function getById($id){
        try {
            $sql = 'SELECT * FROM `bots` WHERE id = :id LIMIT 1';
            $stmt = $this->_dbconn->prepare($sql);
            $stmt->execute(array('id' => $id));
            return $stmt->fetch();
        } catch (PDOException $e) {
            error_log($e->getMessage());
            return array();
        }
    }

    public function updateBId($id,$template){
        try {
            $sql = 'UPDATE `bots` SET `botid` = :bid WHERE `template` = :template;';
            $stmt = $this->_dbconn->prepare($sql);
            $stmt->execute(array('bid' => $id,'template' => $template));
            return true;
        } catch (PDOException $e) {
            error_log($e->getMessage());
            return false;
        }
    }

    public function setOffline($template){
        try {
            $sql = "UPDATE `bots` SET `botid` = NULL, `is_online` = '0' WHERE `template` = :template;";
            $stmt = $this->_dbconn->prepare($sql);
            $stmt->execute(array('template' => $template));
            return true;
        } catch (PDOException $e) {
            error_log($e->getMessage());
            return false;
        }
    }

    public function setBotOffline($id){
        try {
            $sql = "UPDATE `bots` SET `is_online` = '0' WHERE `id` = :id;";
            $stmt = $this->_dbconn->prepare($sql);
            $stmt->execute(array('id' => $id));
            return true;
        } catch (PDOException $e) {
            error_log($e->getMessage());
            return false;
        }
    }

    public function setBotOnline($id){
        try {
            $sql = "UPDATE `bots` SET `is_online` = '1' WHERE `id` = :id;";
            $stmt = $this->_dbconn->prepare($sql);
            $stmt->execute(array('id' => $id));
            return true;
        } catch (PDOException $e) {
            error_log($e->getMessage());
            return false;
        }
    }

    public function deleteBot($id){
        $botdb = $this->getById($id);
        if ($botdb == null){
            return false;
        }
        $bot = $this->_botconn;
        $templates = $this->listTemplates();
        if (self::botOnline($botdb['template'],$templates)){
            $botid = self::findbyTemplate($botdb['template'],$templates);
            if (isset($botid['Id'])){
                $bot->getCommandExecutor()->use($botid['Id']);
                $bot->getCommandExecutor()->disconnect();
            }
        }
        try {
            $sql = 'DELETE FROM `bots` WHERE `id` = :id';
            $stmt = $this->_dbconn->prepare($sql);
            $stmt->execute(array('id' => $id));
            return true;
        } catch (PDOException $e) {
            error_log($e->getMessage());
            return false;
        }
    }

    public function pauseMusic($id){
        $bot = $this->getById($id);
        if (empty($bot)){
            return false;
        }
        $botc = $this->_botconn;
        $botc->getCommandExecutor()->use($bot['botid']);
        $botc->getCommandExecutor()->pause();
        return true;
    }

    public function resumeMusic($id){
        $bot = $this->getById($id);
        if (empty($bot)){
            return false;
        }
        $botc = $this->_botconn;
        $botc->getCommandExecutor()->use($bot['botid']);
        $botc->getCommandExecutor()->unpause();
        return true;
    }

    public function getBot(){
        return $this->_botconn;
    }

    public static function hostOnline(){
        return true;
        //return false;
        $bs = new Bot(1,2);
        $message = $bs->getBot()->getCommandExecutor()->listBots();
        if ($message === NULL){
            return false;
        } else {
            if (isset($message['ErrorName'])){
                error_log("[TS3AB] ERROR: ".json_encode($message));
                return false;
            }
            return true;
        }
    }

    public function listTemplates(){
        $array = $this->_botconn->getCommandExecutor()->listBots();
        if (isset($array['ErrorName'])){
            return array();
        }
        if($array == null){
            return array();
        }
        $botlist = array();
        foreach ($array as $value){
            $botlist[$value['Name']] = $value;
        }
        return $botlist;
    }

    public function findbyTemplate($template,$botlist){
        if (isset($botlist[$template])){
            return $botlist[$template];
        }
        return array();
    }

    public function botOnline($template,$botlist){
        $botlist = self::findbyTemplate($template,$botlist);
        if (isset($botlist['Name'])){
            if($botlist['Status'] == 2){
                return true;
            }
        }
        return false;
    }

    public function changePassword($id,$passowrd){
        $bot = self::getById($id);
        if (empty($bot)){
            return false;
        }
        if ($passowrd == $bot[' _password']){
            return true;
        }
        try {
            $sql = 'UPDATE `bots` SET `host_password` = :host_password WHERE `id` = :id;';
            $stmt = $this->_dbconn->prepare($sql);
            $stmt->execute(array('id' => $id,'host_password' => $passowrd));
            $this->_botconn->getCommandExecutor()->setBotSettings($bot['template'],'connect.server_password.pw',$passowrd);
            return true;
        } catch (PDOException $e) {
            error_log($e->getMessage());
            return false;
        }
    }

    public function changeSChannel($id,$channel){
        $bot = self::getById($id);
        if (empty($bot)){
            error_log('BOT NOT FOUND');
            return false;
        }
        if ($channel === ''){
            $channel = ' ';
        }
        if (is_numeric($channel)){
            $channel = '/'.$channel;
        }
        try {
            $sql = 'UPDATE `bots` SET `default_channel` = :default_channel WHERE `id` = :id;';
            $stmt = $this->_dbconn->prepare($sql);
            $stmt->execute(array('id' => $id,'default_channel' => $channel));
            error_log(json_encode($this->_botconn->getCommandExecutor()->setBotSettings($bot['template'],'connect.channel',$channel)));
            return true;
        } catch (PDOException $e) {
            error_log($e->getMessage());
            return false;
        }
    }

    public static function getUserQuickPlay(){
        return json_decode(Auth::getInstance()->getCurrentUser()->private_streamurl,true);
    }

    public static function getQuickPlay(){
        $array = file_get_contents('quickplay/stations.php');
        //$array = null;
        if($array == NULL){
            $array = array(
                'Sender' => array(
				  "#original" => "https://listen.reyfm.de/original_128kbps.mp3",
				  "#nightlife" => "https://listen.reyfm.de/nightlife_128kbps.mp3",
				  "#raproyal" => "https://listen.reyfm.de/raproyal_128kbps.mp3",
				  "#summerjam" => "https://listen.reyfm.de/summerjam_128kbps.mp3",
				  "#underground" => "https://listen.reyfm.de/underground_128kbps.mp3",
				  "#hitsonly" => "https://listen.reyfm.de/hitsonly_128kbps.mp3",
				  "#gaming" => "https://listen.reyfm.de/gaming_128kbps.mp3",
				  "#houseparty" => "https://listen.reyfm.de/houseparty_128kbps.mp3",
				  "#chillout" => "https://listen.reyfm.de/chillout_128kbps.mp3",
				  "#exclusive" => "https://listen.reyfm.de/exclusive_128kbps.mp3",
				  "#dancehall" => "https://listen.reyfm.de/dancehall_128kbps.mp3",
				  "#mashup" => "https://listen.reyfm.de/mashup_128kbps.mp3",
				  "#warzone" => "https://listen.reyfm.de/warzone_128kbps.mp3",
				  "#djradio" => "https://listen.reyfm.de/djradio_128kbps.mp3",
				  "#oldschool" => "https://listen.reyfm.de/oldschool_128kbps.mp3",
				  "#mainstage" => "https://listen.reyfm.de/mainstage_128kbps.mp3",
				  "#charts" => "https://listen.reyfm.de/charts_128kbps.mp3",
				  "iLoveRadio" => "http://stream01.ilovemusic.de/iloveradio1.mp3",
				  "iLove2Dance" => "http://stream01.ilovemusic.de/iloveradio2.mp3",
				  "iLoveDeutschrap" => "http://stream01.ilovemusic.de/iloveradio6.mp3",
				  "iLoveMashup" => "http://stream01.ilovemusic.de/iloveradio5.mp3",
				  "iLoveMusicAndChill" => "http://stream01.ilovemusic.de/iloveradio10.mp3",
				  "iLoveTheBattle" => "http://stream01.ilovemusic.de/iloveradio3.mp3",
				  "#original" => "https://synexitfm.stream.laut.fm => 8080/synexitfm",
				  "#nightlife" => "https://synexitfmrap.stream.laut.fm/synexitfmrap",
				  "#charts" => "https://synexitfm80er.stream.laut.fm => 8080/synexitfm80er",
                )
            );
			
        } else {
            $array = json_decode($array,true);
        }
        $custom = self::getUserQuickPlay();
        if (!empty($custom)){
            $array['Custom'] = self::getUserQuickPlay();
        }
        return $array;
    }

    public function changeOwner($id,$userid){
        try {
            $sql = 'UPDATE `bots` SET `owner` = :userid WHERE `id` = :id;';
            $stmt = $this->_dbconn->prepare($sql);
            $stmt->execute(array('id' => $id,'userid' => $userid));
            return true;
        } catch (PDOException $e) {
            error_log($e->getMessage());
            return false;
        }
    }

    public static function botTemplateList(){
        $tmplist = array();
        foreach (Config::nodes as $node => $config){
            $bot = new Bot($node);
            $list = $bot->listTemplates();
            $tmplist = array_merge($list, $tmplist);
        }
        return $tmplist;
    }

    public static function countNodes(){
        try {
            $sql = 'SELECT node, COUNT(id) AS active FROM bots GROUP BY node ORDER BY active ASC';
            $stmt = Database::getDB()->prepare($sql);
            $stmt->execute();
            return $stmt->fetchAll();
        } catch (PDOException $e) {
            error_log($e->getMessage());
            return false;
        }
    }

    public static function setNodeStatus($nodeid,$online){
        try {
            $sql = 'UPDATE bots SET node_online = :onln WHERE node = :node';
            $stmt = Database::getDB()->prepare($sql);
            if ($online){
                $onl = 1;
            } else {
                $onl = 0;
            }
            $stmt->execute(array('onln' => $onl, 'node' => $nodeid));
            if ($stmt->rowCount() == 1){
                return true;
            }
            return false;
        } catch (PDOException $e) {
            error_log($e->getMessage());
            return false;
        }
    }
}