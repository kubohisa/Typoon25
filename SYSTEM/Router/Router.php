<?php

/**
 *  Php Settings.
 */

mb_language("Japanese");
mb_internal_encoding("UTF-8");

date_default_timezone_set('Asia/Tokyo');

/**
 *  Typoon 初期設定
 */

// if (!defined('systemName')) exit;

define("systemName", "TypoonV4");

define("tyDirRouter", str_replace("\\", "/", __DIR__)); // Windows's Path "\" -> "/".
define("tyDirRoot", tyDirRouter . "/../..");

//define("tyPath", tyDirRoot . "/Typoon/");
define("tySystemPath", tyDirRoot . "/SYSTEM/");
define("tyLibrarysPath", tyDirRoot . "/Librarys/");

require_once(tyDir . "/../Setting/setting.php");

/**
 *  Waf.
 */

require_once(tySystemPath . "Router/Waf.php");

/*
	ファイルがあれば、それを表示
*/

if (file_exists("." . $_SERVER["REQUEST_URI"]) && $_SERVER["REQUEST_URI"] !== "/") {
    require_once(tySystemPath . "Router/RealFileEcho.php");
}

/**
 * autoloader.
 */

require_once(tySystemPath . "Router/Autoloader.php");

/*
	require.
*/

require_once(tyLibrarysPath . "System/Token.php");
require_once(tyLibrarysPath . "System/Loger.php");
require_once(tyLibrarysPath . "System/Std.php");
require_once(tyLibrarysPath . "System/Hash.php");

/**
 *  Session Seting.
 */

require_once(tySystemPath . "Router/SettingSession.php");

/**
 *  Error message?
 */

require_once(tySystemPath . "Router/Errormessage.php");

/*

*/

// Lifeチェック

if ($_SERVER["REQUEST_URI"] === "/life") {
    require_once(tySystemPath . "Router/LifeCheck.php");
}

// logout.

if ($_SERVER["REQUEST_URI"] === "/logout") {
    //
    require_once(tySystemPath . "Router/DeleteSession.php");

    // Go TopPage.
    //        header("Location: /logout.html");
    header("Location: /");
    exit;
}

/**
 *  EXEC.
 */

require_once(tySystemPath . "Router/UrlFunc.php");

// Not EXEC then Error page.

Std::errorPage(404);

exit;
