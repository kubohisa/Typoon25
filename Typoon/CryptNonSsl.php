<?php

class CryptNonSsl
{
    /**
     *  暗号化
     */

    static function Encrypt($data)
    {
        /**
         *  暗号化する時のパラメーター
         */

        $pass = 'password';
        $iv = '1234567890123456'; //16桁

        // SSLを（ちゃんと）使ってない暗号化
        return openssl_encrypt(
            $data,
            'aes-256-cbc',
            $pass,
            OPENSSL_RAW_DATA,
            $iv
        );
    }
}
