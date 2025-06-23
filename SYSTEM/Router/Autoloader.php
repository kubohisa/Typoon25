<?php

spl_autoload_register(function ($class) {
    $class = str_replace('\\', '/', $class) . ".php";

    if (explode("/", $class)[0] === "Typoon" && file_exists(tyLibrariesPath . $class)) {
        require_once(tyLibrariesPath . $class);
    } elseif (file_exists(tyLibrariesPath . "extLib/" . $class)) {
        require_once(tyLibrariesPath . "extLib/" . $class);
    }
});

/**
 * 強制的読み込みを行うなら、以降で require_once
 */

 // require_once();
