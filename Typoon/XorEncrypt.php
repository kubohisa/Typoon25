<?php

class XorEncrypt
{
    /**
     *  XORを使った簡易ストリーム暗号化クラス
     * 
     *  Copilotで生成した関数を手作業でクラス化
     */

    static $key = "RandomStringData"; // ランダムな数列や文字列。なるべく長く

    /**
     *  暗号化
     */

    static function Encrypt($data)
    {
        $keyLength = strlen(self::$key);
        $encrypted = '';

        for ($i = 0, $len = strlen($data); $i < $len; $i++) {
            $encrypted .= $data[$i] ^ self::$key[$i % $keyLength];
        }

        return base64_encode($encrypted);
    }

    /**
     *  復号化
     */

    static function Decrypt($encryptedData)
    {
        $keyLength = strlen(self::$key);
        $data = base64_decode($encryptedData);
        $decrypted = '';

        for ($i = 0, $len = strlen($data); $i < $len; $i++) {
            $decrypted .= $data[$i] ^ self::$key[$i % $keyLength];
        }

        return $decrypted;
    }
}
