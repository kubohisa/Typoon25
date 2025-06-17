<?php

class Responder
{
    /**
     * JSON出力
     */

    public static function json($data)
    {
        header("Content-Type: application/json; charset=UTF-8");
        echo json_encode($data);

        exit;
    }

    /**
     * Location処理
     */

    public static function location($url)
    {
        /**
         * URLチェック.
         */
        if (! filter_var($url, FILTER_VALIDATE_URL)) {
            Std::errorPage(503);
        }

        /**
         * Location処理
         */

        header("Location: " . $url);

        exit;
    }
}
