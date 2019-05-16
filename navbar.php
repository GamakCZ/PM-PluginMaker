<?php

define("DEFAULT_NAVBAR", 0);
define("ADVANCED_NAVBAR", 1);

/**
 * @param int $type
 * @return string
 */
function getNavbar(int $type = DEFAULT_NAVBAR): string {
    try {
        if($type === DEFAULT_NAVBAR)
            return file_get_contents(getcwd() . DIRECTORY_SEPARATOR . "empty-navbar.html");
        else
            return file_get_contents(getcwd() . DIRECTORY_SEPARATOR . "navbar.html");
    }
    catch (Exception $exception) {
        return "";
    }
}