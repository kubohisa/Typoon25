<?php

class Password
{
    public function hash($password)
    {
        $pass = 'password';
        $iv = '1234567890123456'; //16桁

        // 暗号化
        $value = openssl_encrypt(
            "Dummy" . $password,
            'aes-256-cbc',
            $pass,
            OPENSSL_RAW_DATA,
            $iv
        );

        // Hash.
        return hash_hmac('sha512', $value, 'secret', false);
    }
} // 引っ越し先