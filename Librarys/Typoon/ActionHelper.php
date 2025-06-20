<?php

class ActionHelper
{
    /**
     * POSTからJSONを取得する
     */

    public static function json()
    {
        return json_decode(file_get_contents("php://input"), true);
    }
}
