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
     * Output File.
     */

    public static function file($file, $data, $dir = tyDirDocument . "/")
    {
        return file_put_contents($dir . $file, $data);
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
