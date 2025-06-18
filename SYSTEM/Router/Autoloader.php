<?php

spl_autoload_register(function ($class) {
    $class = str_replace('\\', '/', $class) . ".php";

    if (file_exists(tyLibrarysPath . $class)) {
        require_once(tyLibrarysPath . $class);
    } elseif (file_exists(tyLibrarysPath . "extLib/" . $class)) {
        require_once(tyLibrarysPath . "extLib/" . $class);
    }
});

/**
 * 強制的読み込みを行うなら、以降で require_once
 */

 // require_once();
