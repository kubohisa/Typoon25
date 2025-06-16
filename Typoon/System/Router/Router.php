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
define("tyPath", "../../../Typoon/");
define("extLibPath", "../../../extLib/");

require_once("../Setting/setting.php");

/*
	require.
*/

require_once(tyPath . "System/Token.php");
require_once(tyPath . "System/Loger.php");
require_once(tyPath . "System/Std.php");

/**
 *  Waf.
 */

require_once(tyPath . "System/Router/Waf.php");

/*
	ファイルがあれば、それを表示
*/

if (file_exists("." . $_SERVER["REQUEST_URI"]) && $_SERVER["REQUEST_URI"] !== "/") {
    require_once(tyPath . "System/Router/RealFileEcho.php");
}

/**
 *  Session Seting.
 */

require_once(tyPath . "System/Router/SettingSession.php");

/**
 *  Error message?
 */

require_once(tyPath . "System/Router/Errormessage.php");

/*

*/

// Lifeチェック

if ($_SERVER["REQUEST_URI"] === "/life") {
    require_once(tyPath . "System/Router/LifeCheck.php");
}

// logout.

if ($_SERVER["REQUEST_URI"] === "/logout") {
    //
    require_once(tyPath . "System/Router/DeleteSession.php");

    // Go TopPage.
    //        header("Location: /logout.html");
    header("Location: /");
    exit;
}

/**
 *  EXEC.
 */

require_once(tyPath . "System/Router/UrlFunc.php");

// Not EXEC then Error page.

Std::errorPage(404);

exit;
