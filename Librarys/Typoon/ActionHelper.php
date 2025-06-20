<?php

class ActionHelper
{
    public static function json()
    {
        return json_decode(file_get_contents("php://input"), true);
    }
}
