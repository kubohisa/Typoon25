<?php

/**
 * ブラウザからのデータ置き場
 * 
 * $_GETを削除しているため。ブラウザーからのデータをクラスで持ってフラットで扱う
 */
class Res
{
    /**
     * 
     */

    public static $POST = array();
    public static $GET = array();
    public static $COOKIE = array();

    public static $METHOD = "";

    /**
     * Setting Res::$METHOD.
     */

    public static function methodSet()
    {
        if ($_SERVER['REQUEST_METHOD'] === "POST") {
            self::$METHOD = "POST";

            if (empty(self::$POST['formMode'])) self::$POST['formMode'] = "";
        } elseif (! empty(self::$GET)) {
            self::$METHOD = "GET";
        }
    }
}
