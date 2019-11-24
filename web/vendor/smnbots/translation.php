<?php
/**
 * Created by PhpStorm.
 * User: janni
 * Date: 21.02.2019
 * Time: 19:02
 */

namespace smnbots;


class translation
{

    private static $langs = array('de' => 'Deutsch','us' => 'English');

    public static function setLang($lang){
        if (array_key_exists(strtolower($lang),self::$langs)){
            User::saveLang(strtolower($lang));
            $_SESSION['LANG'] = strtolower($lang);
            return true;
        }
        return false;
    }

    public static function getLang(){
        if (isset($_SESSION['LANG'])){
            return $_SESSION['LANG'];
        }
        if (array_key_exists(strtolower(Auth::getInstance()->getCurrentUser()->language),self::$langs)){
            return strtolower(Auth::getInstance()->getCurrentUser()->language);
        }
        return 'de';
    }

    public static function getLangs(){
        return self::$langs;
    }

    public static function getPHP(){
        $lang = self::getLang();
        $_LANG = array();
        include 'lang/'.$lang.'.lang.php';
        return $_LANG;
    }

    public static function getJS(){
        $lang = self::getLang();
        return '<script src="/assets/js/lang/'.$lang.'.lang.js"></script>';
    }


}