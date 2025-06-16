<?php

class Std
{
    public static function errorPage($code)
    {
        if ($code !== 503) {
            $code = 404;
        }

        header("Location: /{$code}.html");
        exit;
    }
}
