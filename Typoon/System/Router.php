<?php

/*
	.
*/

function errorPage($code)
{
    if ($code !== 503) {
        $code = 404;
    }

    header("Location: /{$code}.html");
    exit;
}

/*
	Init.
*/

// if (!defined('systemName')) exit;

define("systemName", "TypoonV4");
define("tyPath", "../../../Typoon/");

$EXEC = "";

$URI = "";

$GET = array();

/*
	Php Settings.
*/

mb_language("Japanese");
mb_internal_encoding("UTF-8");

date_default_timezone_set('Asia/Tokyo');

// Setting.

require_once("../Setting/setting.php");

// Waf.

require_once(tyPath . "System/Router/Waf.php");

/*
	ファイルがあれば、それを表示
*/

$URI = $_SERVER["REQUEST_URI"];

if ($URI === "/router.php") {
    errorPage(404);
    exit;
}

require_once(tyPath . "System/Router/RealFileEcho.php");

/*

*/

// Session Seting.

ini_set('session.cookie_httponly', 1); // http only.

ini_set('session.use_strict_mode', 1); // server mode only.

if (isset($_SERVER['HTTPS'])) {
    ini_set('session.cookie_secure', 1);
} // if https then.

session_name(typoon::$SessionName);

session_set_cookie_params(3600);

session_start();

session_regenerate_id();

// Error message?

if (typoon::$Debug === true) {
    ini_set('display_errors', 'On');
    ini_set('display_startup_errors', 'On');
    ini_set('error_reporting', -1);
} else {
    ini_set('display_errors', 'Off');
    ini_set('display_startup_errors', 'Off');
    ini_set('error_reporting', 0);
}

ini_set('log_errors', 'On');
ini_set('error_log', '../../../Log/error.log');

/*

*/

// Lifeチェック

if ($_SERVER["REQUEST_URI"] === "/life") {
    require_once(tyPath . "System/Router/LifeCheck.php");
}

// logout.

if ($_SERVER["REQUEST_URI"] === "/logout") {
    // Delete Session.
    $_SESSION = array();

    if (isset($_COOKIE["PHPSESSID"])) {
        setcookie("PHPSESSID", '', time() - 1800, '/');
    }

    session_destroy();

    // Go TopPage.
    //        header("Location: /logout.html");
    header("Location: /");
    exit;
}

/*
	require.
*/
require_once(tyPath . "System/Token.php");
require_once(tyPath . "System/Loger.php");

/*
	EXEC.
*/

require_once(tyPath . "System/Router/UrlFunc.php");

// Not EXEC then Error page.

errorPage(404);

exit;
