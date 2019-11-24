<?php
/**
 * Created by PhpStorm.
 * User: janni
 * Date: 03.02.2019
 * Time: 15:37
 */

namespace smnbots;


use PDOException;

class changelog
{
    public static function getChangelogs(){
        try {
            $db = Database::getDB();
            $sql = 'SELECT * FROM `changelog` WHERE `id` != 0 ORDER BY `date` DESC';
            $stmt = $db->prepare($sql);
            $stmt->execute();
            return $stmt->fetchAll();
        } catch (PDOException $e) {
            error_log($e->getMessage());
            return array();
        }
    }

    public static function getNotify(){
        try {
            $db = Database::getDB();
            $sql = 'SELECT * FROM `changelog`WHERE id = 0 LIMIT 1';
            $stmt = $db->prepare($sql);
            $stmt->execute();
            return $stmt->fetch();
        } catch (PDOException $e) {
            error_log($e->getMessage());
            return array();
        }
    }

    public static function deleteChangelog($id){
        try {
            $db = Database::getDB();
            $sql = 'DELETE FROM `changelog` WHERE `id` = :id';
            $stmt = $db->prepare($sql);
            $stmt->execute(array('id' => $id));
            return true;
        } catch (PDOException $e) {
            error_log($e->getMessage());
            return false;
        }
    }

    public static function createChangelog($title,$message){
        try {
            $dbconn = Database::getDB();
            $stmt = $dbconn->prepare('INSERT INTO `changelog` (`id`, `title`, `message`, `date`) VALUES (NULL, :title, :msg, CURRENT_TIMESTAMP)');
            $bindings= array(
                'title'    => $title,
                'msg'   => $message
            );
            $stmt->execute($bindings);
            return true;
        } catch (\PDOException $e) {
            error_log($e->getMessage());
            return false;
        }
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