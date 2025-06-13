<?php

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
