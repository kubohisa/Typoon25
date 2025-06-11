<?php

require_once("../Setting/setting.php");

class XorCrypt
{
    /**
     *  XORを使った簡易ストリーム暗号化クラス
     * 
     *  Copilotで生成した関数を手作業でクラス化
     */

    //static $key = "RandomStringData"; // ランダムな数列や文字列。なるべく長く


    /**
     *  暗号化
     */

    static function Encrypt($data)
    {
        $keyLength = strlen(typoon::$XorCryptKey);
        $encrypted = '';

        for ($i = 0, $len = strlen($data); $i < $len; $i++) {
            $encrypted .= $data[$i] ^ typoon::$XorCryptKey[$i % $keyLength];
        }

        return base64_encode($encrypted);
    }

    /**
     *  復号化
     */

    static function Decrypt($encryptedData)
    {
        $keyLength = strlen(typoon::$XorCryptKey);
        $data = base64_decode($encryptedData);
        $decrypted = '';

        for ($i = 0, $len = strlen($data); $i < $len; $i++) {
            $decrypted .= $data[$i] ^ typoon::$XorCryptKey[$i % $keyLength];
        }

        return $decrypted;
    }
}
