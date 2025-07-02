<?php

// Null check.

function sanitizer($arr)
{
    if (is_array($arr)) {
        return array_map('sanitizer', $arr);
    }

    // Null byte.
    if (strpos($arr, "\0") !== false) {
        Std::errorPage(503);
        exit;
    }

    // Control Code.
    if (preg_match("/[\x01-\x08\x0B\x0C\x0E-\x1F\x7F]/", $arr)) {
        Std::errorPage(503);
        exit;
    }

    // UTE-8.
    //	$arr = mb_convert_encoding($arr, 'UTF-8', 'UTF-8');

    //
    if (! mb_check_encoding($arr, 'UTF-8')) {
        Std::errorPage(503);
        exit;
    }

    // Html escape.
    /*    $arr = htmlentities($arr, ENT_QUOTES);
    */

    return $arr;
}

// HTTPS?

if (typoon::$Https === true && empty($_SERVER['HTTPS'])) {
    exit;
}

// Domainチェック

/*    if ($_SERVER['HTTP_HOST'] !== typoon::$DomainName) {
        Std::errorPage(404);
        exit;
    }
*/

// URLの文字チェック

if (! preg_match("#\A[A-Za-z0-9\-\.\_\~\/\%]+\z#", $_SERVER["REQUEST_URI"])) {
    Std::errorPage(404);
    exit;
}

// URLの長さチェック

if (strlen($_SERVER["REQUEST_URI"]) > 1000) {
    Std::errorPage(404);
    exit;
}

// Nullバイトチェック

$_GET = array();

$_POST = sanitizer($_POST);
Res::$POST = &$_POST;

$_COOKIE = sanitizer($_COOKIE);
Res::$COOKIE = &$_COOKIE;

$_SERVER = sanitizer($_SERVER);
