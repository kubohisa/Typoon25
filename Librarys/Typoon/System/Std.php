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
}
