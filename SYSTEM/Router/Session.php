<?php

class Session
{
    public static function start()
    {

        session_name(typoon::$SessionName);

        if (isset($_SERVER['HTTPS'])) {
            ini_set('session.cookie_secure', 1);
        } // if https then.

        ini_set('session.cookie_httponly', 1); // http only.
        ini_set('session.use_strict_mode', 1); // server mode only.

        session_set_cookie_params(3600);
        session_start();

        if (time() % 10 === 0) { // 10%の確率でsession idをリセット
            session_regenerate_id(true);
        }
    }

    public static function end()
    {
        // Delete Session.
        $_SESSION = array();

        if (isset($_COOKIE["PHPSESSID"])) {
            setcookie("PHPSESSID", '', time() - 1800, '/');
        }

        session_destroy();
    }
}
