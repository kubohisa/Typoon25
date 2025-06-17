<?php

class Login
{
    public static function start($id)
    {
        Token::uid($id);

        $_SESSION['LoginId'] = $id;

        session_regenerate_id(true);
    }

    public static function check()
    {
        if (isset($_SESSION['LoginId'])) {
            return $_SESSION['LoginId'];
        }

        header("Location: /logout");
        exit;
    }

    public static function logout()
    {
        header("Location: /logout");
        exit;
    }

    //
    public static function move($path)
    {
        header("Location: {$path}");
        exit;
    }
}
