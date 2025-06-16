<?php

class Form
{
    /*

    */

    public static function mode($mode)
    {
        if (isset($_POST['mode']) && trim($_POST['mode']) === $mode) {
            return true;
        }
        return false;
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

    /*

    */

    public static function start()
    {
        $_SESSION['TyIpToken'] = Token::ipToken();
        $_SESSION['TyFormToken'] = Token::formToken();

        return $_SESSION['TyFormToken'];
    }

    public static function Check($var)
    {

        //
        if (empty($_SESSION['TyIpToken'])) {
            return false;
        }

        if (empty($_SESSION['TyFormToken'])) {
            return false;
        }

        //
        $ipcheck = $_SESSION['TyIpToken'];
        unset($_SESSION['TyIpToken']);

        $check = $_SESSION['TyFormToken'];
        unset($_SESSION['TyFormToken']);

        if ($check === $var && $ipcheck === Token::ipToken()) {
            return true;
        }
        return false;
    }
}
