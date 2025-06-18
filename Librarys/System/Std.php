<?php

class Std
{
    /**
     * Eroor Page.
     */

    public static function errorPage($code)
    {
        if ($code !== 503) {
            $code = 404;
        }

        header("Location: /{$code}.html");
        exit;
    }

    /**
     * mb_trim.
     */

    public static function mbTrim($text)
    {
        return preg_replace('#\A[\p{C}\p{Z}]++|[\p{C}\p{Z}]++\z#u', '', $text);
    }

    /**
     * Text trim.
     */

    public static function textTrim($text)
    {
        return preg_replace('/^(?:[\p{C}\p{Z}]*\R)+|(?:\R[\p{C}\p{Z}]*$)+/mu', '', $text); // Copilit.
    }

    /**
     * $GET チェック
     */

    public static function checkGetNull($key)
    {
        global $GET;

        if (empty($GET[$key])) {
            return true;
        }
        return false;
    }

    /**
     * Print Debug.
     */

    public static function printDebug($data)
    {
        var_dump($data);
        exit;
    }
}
