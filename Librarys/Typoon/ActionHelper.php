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

    public static function jsonPost($id)
    {
        if (empty($_POST[$id])) return array();
        return json_decode(file_get_contents($_POST[$id]), true);
    }
}
