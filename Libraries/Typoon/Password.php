<?php

class Password
{
    public function hash($password)
    {
        /**
         *  パスワードを暗号化してからハッシュ化する時のパラメーター
         */

        $pass = 'password';
        $iv = '1234567890123456'; //16桁

        $dummy = 'Dummystring';

        $hash = 'secret';

        /**
         *  暗号化
         */

        // パスワードへ文字列を追加して、パスワードを変身させてハッシュをずらすロスト・テクノロジー
        $password = substr_replace($dummy, $password, 4);

        // SSLを（ちゃんと）使ってない暗号化
        $value = openssl_encrypt(
            $password,
            'aes-256-cbc',
            $pass,
            OPENSSL_RAW_DATA,
            $iv
        );

        /**
         *  Hash化
         */

        return hash_hmac('sha512', $value, $hash, false);
    }
} // 引っ越し先