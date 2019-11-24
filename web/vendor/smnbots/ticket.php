<?php
/**
 * Created by PhpStorm.
 * User: janni
 * Date: 19.01.2019
 * Time: 22:49
 */

namespace smnbots;

use PDOException;

class ticket
{
    public static function ticketlist(){
        try {
            $db = Database::getDB();
            $sql = 'SELECT * FROM `tickets` ORDER BY `status` ASC';
            $stmt = $db->prepare($sql);
            $stmt->execute();
            return $stmt->fetchAll();
        } catch (PDOException $e) {
            error_log($e->getMessage());
            return array();
        }
    }

    public static function ticketliststs($stat){
        try {
            $db = Database::getDB();
            $sql = 'SELECT * FROM `tickets` WHERE `status` = :sts';
            $stmt = $db->prepare($sql);
            $stmt->execute(array('sts' => $stat));
            return $stmt->fetchAll();
        } catch (PDOException $e) {
            error_log($e->getMessage());
            return array();
        }
    }

    public static function ticketlistUser($user){
        try {
            $db = Database::getDB();
            $sql = 'SELECT * FROM `tickets` WHERE user_id = :uid';
            $stmt = $db->prepare($sql);
            $stmt->execute(array('uid' => $user));
            return $stmt->fetchAll();
        } catch (PDOException $e) {
            error_log($e->getMessage());
            return array();
        }
    }

    public static function getTicket($id){
        try {
            $db = Database::getDB();
            $sql = 'SELECT * FROM `tickets` WHERE ticket_id = :tid LIMIT 1';
            $stmt = $db->prepare($sql);
            $stmt->execute(array('tid' => $id));
            if ($stmt->rowCount() == 1){
                $data = $stmt->fetch();
                if ($data['user_id'] == Auth::getInstance()->getCurrentUser()->id || Auth::getInstance()->isAdmin()){
                    return $data;
                } else {
                    return false;
                }
            }
        } catch (PDOException $e) {
            error_log($e->getMessage());
        }
        return false;
    }

    public static function getAnswers($tid){
        try {
            $db = Database::getDB();
            $sql = 'SELECT * FROM `ticket_history` WHERE ticket_id = :tid';
            $stmt = $db->prepare($sql);
            $stmt->execute(array('tid' => $tid));
            return $stmt->fetchAll();
        } catch (PDOException $e) {
            error_log($e->getMessage());
        }
        return false;
    }

    public static function addAnswer($message,$ticketid){
        $uid = Auth::getInstance()->getCurrentUser()->id;
        $ticket = self::getTicket($ticketid);
        if ($ticket['user_id'] !== $uid){
            if (!Auth::getInstance()->isAdmin()){
                return false;
            } else {
                if ($ticket['smn_id'] == 0){
                    self::setEditor($ticketid,$uid);
                }
                self::setStatus($ticketid,2);
            }
        } else {
            self::setStatus($ticketid,1);
        }

        try {
            $db = Database::getDB();
            $sql = 'INSERT INTO `ticket_history` (`id`, `ticket_id`, `user_id`, `message`, `seen`) VALUES (NULL, :tid, :uid, :msg, 0)';
            $stmt = $db->prepare($sql);
            $stmt->execute(array('tid' => $ticketid,'uid' => $uid,'msg'=>$message));
            return true;
        } catch (PDOException $e) {
            error_log($e->getMessage());
        }
        return false;
    }

    public static function createTicket($title,$message,$botid,$category){
        try {
            $db = Database::getDB();
            $sql = 'INSERT INTO `tickets` (`ticket_id`, `user_id`, `bot_id`, `name`, `message`, `status`, `category`) VALUES (NULL, :uid, :bid, :title, :message, 0, :cat)';
            $stmt = $db->prepare($sql);
            $stmt->execute(array('uid' => Auth::getInstance()->getCurrentUser()->id, 'bid' => $botid, 'title' => $title, 'message' => $message,'cat' => $category));
            return true;
        } catch (PDOException $e) {
            error_log($e->getMessage());
        }
        return false;
    }

    public static function setStatus($ticketid,$status){
        try {
            $db = Database::getDB();
            $sql = 'UPDATE `tickets` SET `status` = :sts WHERE `ticket_id` = :tid';
            $stmt = $db->prepare($sql);
            $stmt->execute(array('tid' => $ticketid,'sts' => $status));
            if ($stmt->rowCount() == 1) {
                return true;
            }
        } catch (PDOException $e) {
            error_log($e->getMessage());
        }
        return false;
    }

    public static function setEditor($ticketid,$editorid){
        try {
            $db = Database::getDB();
            $sql = 'UPDATE `tickets` SET `smn_id` = :eid WHERE `ticket_id` = :tid';
            $stmt = $db->prepare($sql);
            $stmt->execute(array('tid' => $ticketid,'eid' => $editorid));
            if ($stmt->rowCount() == 1) {
                return true;
            }
        } catch (PDOException $e) {
            error_log($e->getMessage());
        }
        return false;
    }

    public static function getCount($uid){
        try {
            $db = Database::getDB();
            $sql = 'SELECT * FROM `tickets` WHERE user_id = :uid AND `status` = 0';
            $stmt = $db->prepare($sql);
            $stmt->execute(array('uid' => $uid));
            return count($stmt->fetchAll());
        } catch (PDOException $e) {
            error_log($e->getMessage());
            return array();
        }
    }
}