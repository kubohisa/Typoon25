<?php

/**
 *  
 */

function urlFunc($GET, $EXEC, $URI, $url, $func)
{
    /**
     * 前処理
     */

    $url = Std::mbTrim($url);

    if (! preg_match('#\A[0-9A-Za-z\_\-]+\z#', $func)) {
        Std::errorPage(503);
        exit;
    } // バリデーター

    /**
     *  $urlから正規表現で、パラメーターを取得できる正規表現を作る
     */

    $url = preg_replace("#\/\*([0-9a-zA-z\_\-]+?)(\/|\z)#", "\/(?P<$1>.*?)$1$2", $url); // Use preg "*".

    $url = preg_replace("#\/\:([0-9a-zA-z\_\-]+?)(\/|\z)#", "\/(?P<$1>.*?)$2", $url); // Use preg ":".
    $url = preg_replace("#\/\[([0-9a-zA-z\_\-]+?)\](\/|\z)#", "\/(?P<$1>.*?)$2", $url); // Use preg "[]".
    $url = preg_replace("#\/\{([0-9a-zA-z\_\-]+?)\}(\/|\z)#", "\/(?P<$1>.*?)$2", $url); // Use preg "{}".

    $url = preg_replace("#\/\[\.\.\.([0-9a-zA-z\_\-]+?)\](.*)\z#", "\/(?P<$1>.*?)$2\z", $url); // Use preg "[...]".

    /**
     *  $urlと$URIが正規表現上同じなら実行
     */

    if (preg_match("#\A{$url}\z#", $URI, $arr)) {
        foreach (array_keys($arr) as $key) {
            // URL decode & Trim.
            $arr[$key] = Std::mbTrim(urldecode($arr[$key]));
        }

        // Delete uri data.
        array_shift($arr);

        //
        $GET = $arr;
        $GET = sanitizer($GET);

        //$exec = $value;
        if (! file_exists("../Exec/{$func}/index.php")) {
            Std::errorPage(404);
            exit;
        }

        $EXEC = $func;
        require_once("../Exec/{$func}/index.php");

        exit;
    }
}

/**
 *  Typoon グローバル変数
 */

$EXEC = "";

$URI = $_SERVER["REQUEST_URI"];

$METHOD = $_SERVER['REQUEST_METHOD'];

$GET = array();

/**
 *  設定読み込み
 */

require_once("../Setting/exec.php");

/**
 *  URLソート
 */

array_multisort(
    array_map(
        "strlen",
        array_column(urlFunc::$list, "0")
    ),
    SORT_DESC,
    urlFunc::$list
); // url string length sort.

/**
 *  URLチェック、実行
 */

foreach (urlFunc::$list as [$path, $exec]) {
    urlFunc($GET, $EXEC, $URI, $path, $exec);
}
