<?php

class Hash
{
    public static function sha512($data)
    {
        return hash('sha512', $data);
    }

    public static function ripemd160($data)
    {
        return hash('ripemd160', $data);
    }
}
