<?php

class ActionJson
{
    /**
     * POSTからJSONを取得する
     */

    public static function json()
    {
        if (! $array = json_decode(file_get_contents("php://input"), true)) self::error();
        if (empty($array)) self::error();

        return self::sanitizer($array);
    }

    public static function jsonPost($id)
    {
        if (empty($_POST[$id])) return self::error();

        if (! $array = json_decode($_POST[$id], true)) self::error();
        if (empty($array)) self::error();

        return self::sanitizer($array);
    }

    /**
     * バリデーター
     */

    private static function sanitizer($data)
    {
        if (is_string($data)) {
            if (is_array($data)) {
                return array_map('self::sanitizer', $data);
            }

            // Null byte.
            if (strpos($data, "\0") !== false) {
                self::error();
            }

            // Control Code.
            if (preg_match("/[\x01-\x08\x0B\x0C\x0E-\x1F\x7F]/", $data)) {
                self::error();
            }

            // UTE-8.
            if (! mb_check_encoding($data, 'UTF-8')) {
                self::error();
            }
        }

        return $data;
    }

    /**
     * エラー出力
     */

    private static function error()
    {
        http_response_code(400); // Bad Request

        $time = time();

        header("Content-Type: application/json; charset=UTF-8");
        echo json_encode([
            "Error" => true,
            "Time" => $time
        ]);

        exit;
        //
    }
}
