<?php

class Form
{
    /**
     * 確認画面の為のデータ・キャッシュ
     */

    public static function cacheReset()
    {
        $_SESSION["TyCache"] = array();
    }

    public static function cacheSave($array)
    {
        $_SESSION["TyCache"] = $array;
    }

    public static function cacheLoad()
    {
        return $_SESSION["TyCache"];
    }

    /**
     * Command Pattern.
     * 
     * オートマトンな状態偏移でアプリケーションを動かす時、利用できる
     */

    public static function mode($mode)
    {
        if (isset($_POST['TyMode']) && trim($_POST['TyMode']) === $mode) {
            return true;
        }
        return false;
    }

    public static function modeGet()
    {
        if (empty($_POST['TyMode'])) $_POST['TyMode'] = "";

        return $_POST['TyMode'];
    }

    /*

    */

    public static function domainCheck()
    {
        $url = parse_url($_SERVER['HTTP_REFERER']);

        if ($url['host'] !== typoon::$DomainName) {
            Std::errorPage(503);
            exit;
        }
    }

    /**
     * 
     */

    //
    public static function start($flag = true)
    {
        if ($flag === true) {
            $_SESSION['TyUdidToken'] = Token::udidToken();
        }

        $_SESSION['TyFormToken'] = Token::formToken();

        return $_SESSION['TyFormToken'];
    }

    //
    public static function Check($flag = true)
    {

        //
        if ($flag === true) {
            if (empty($_SESSION['TyIpToken'])) {
                return false;
            }

            $ipcheck = $_SESSION['TyIpToken'];
            unset($_SESSION['TyIpToken']);
        }

        //
        if (empty($_SESSION['TyFormToken'])) {
            return false;
        }

        $check = $_SESSION['TyFormToken'];
        unset($_SESSION['TyFormToken']);

        //
        if (empty($_POST['TyToken'])) {
            return false;
        }

        if ($flag === true) {
            if ($check === $_POST['TyToken'] && $ipcheck === Token::udidToken()) {
                return true;
            }
        } else {
            if ($check === $_POST['TyToken']) {
                return true;
            }
        }
        return false;
    }
}
