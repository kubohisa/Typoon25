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

    public static function passwordArgon2id($password)
    {
        return password_hash($password, PASSWORD_ARGON2ID, [
            'memory_cost' => 1 << 17, // 128MB
            'time_cost'   => 4,
            'threads'     => 2,
        ]);
    }
}
