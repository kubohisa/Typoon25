<?php

class Loger
{
    public static function log($text)
    {
        $file = '../Log/'.date('Ym').'.log';

        error_log(
            "[".date('Y-m-d H:i:s')."] ".$text."\n",
            3,
            $file
        );
    }
}
