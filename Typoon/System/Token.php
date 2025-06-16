<?php

class Token
{
    /*

    */

    public static function ipToken()
    {
        $ip = "";
        if (isset($_SERVER['HTTP_X_FORWARDED_FOR'])) {
            $ip = $_SERVER['HTTP_X_FORWARDED_FOR'];
        } elseif (isset($_SERVER['HTTP_CLIENT_IP'])) {
            $ip = $_SERVER['HTTP_CLIENT_IP'];
        } else {
            $ip = $_SERVER['REMOTE_ADDR'];
        }

        $_SESSION['TyIpToken'] = hash(
            'ripemd160',
            $ip . $_SERVER['HTTP_USER_AGENT'] . $_SERVER['HTTP_ACCEPT_LANGUAGE']
        );
        // スマホなどはipアドレスが変化する可能性があるので、フォーム作成時ハッシュ作成

        return $_SESSION['TyIpToken'];
    }

    /*

    */

    public static function uid($id)
    {
        //
        $_SESSION['uuId'] = strtoupper(hash(
            'sha512',
            hash('sha512', $id) . "_" .
                hash('sha512', "NameSpace") . "_" .
                //	hash('sha512', $_SERVER['REMOTE_ADDR'])."_".
                hash('sha512', microtime()) . "_" .
                hash('sha512', rand())
        ));

        //
        $_SESSION['guId'] = substr(substr_replace($_SESSION['uuId'], 'A', 16, 1), 0, 32);
        //      $_SESSION['guId'] = substr_replace($_SESSION['guId'], '4', 12, 1); // uuid V4
        $_SESSION['guId'] = preg_replace('#\A(.{8})(.{4})(.{4})(.{4})(.{12})#', '$1-$2-$3-$4-$5', $_SESSION['guId']);
    }

    /*

    */

    public static function uidOriginal($id)
    {
        //
        return $id . ":" .
            substr(str_shuffle(str_shuffle(hash('ripemd160', uniqid()))), 0, 14) . ":" .
            substr((string)time(), -10);
    }

    /**
     * ランダムなテキスト生成（仮組み）
     * 
     * MSXBAISCの頃のアルゴリズムで
     */

    public static function randomWordClassic($len)
    {
        $text = '';

        for ($i = 0; $i < $len; $i++) {
            $text .= chr(random_int(33, 91));
        }

        return $text;
    }

    /**
     * ランダムなテキスト生成
     */

    public static function randomWord($length = 10)
    {
        return substr(str_shuffle(hash('ripemd160', uniqid('', true))), 0, $length);
    }

    /**
     * 16byte Random.
     */

    public static function random16byte()
    {
        return random_bytes(16);
    }

    public static function random16byteHex()
    {
        return bin2hex(self::random16byte());
    }

    public static function randomBase32()
    {
        return base_convert(self::random16byte(), 10, 32);
    }

    /**
     * Systemtime.
     */

    public static function systemtime()
    {
        return microtime(true) * 1000000;
    }

    public static function systemtimeHex()
    {
        return dechex(self::systemtime());
    }

    public static function systemtimeBase32()
    {
        return base_convert(self::systemtime(), 10, 32);
    }

    /**
     * フォーム向けトークン
     */

    public static function formToken()
    {
        return str_shuffle(hash('ripemd160', uniqid('', true)));
    }
}
