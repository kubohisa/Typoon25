<?php

class Responder
{
    public static function json($data)
    {
        header("Content-Type: application/json; charset=UTF-8");
        echo json_encode($data);

        exit;
    }
}
