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
     */

    public static function mode($mode)
    {
        if (isset($_POST['formMode']) && trim($_POST['formMode']) === $mode) {
            return true;
        }
        return false;
    }

    public static function modeGet()
    {
        if (empty($_POST['formMode'])) $_POST['formMode'] = "";

        return $_POST['formMode'];
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

    public static function start($flag = true)
    {
        if ($flag === true) {
            $_SESSION['TyUdidToken'] = Token::udidToken();
        }

        $_SESSION['TyFormToken'] = Token::formToken();

        return $_SESSION['TyFormToken'];
    }

    public static function Check($var, $flag = true)
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

        if ($flag === true) {
            if ($check === $var && $ipcheck === Token::udidToken()) {
                return true;
            }
        } else {
            if ($check === $var) {
                return true;
            }
        }
        return false;
    }
}
