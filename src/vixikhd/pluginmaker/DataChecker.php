<?php

declare(strict_types=1);

namespace vixikhd\pluginmaker;

define("CHECK_ALL", 0);

/**
 * Class DataChecker
 * @package vixikhd\pluginmaker
 */
class DataChecker {

    public const ALLOWED_APIS = ["3.0.0"]; // todo implement from poggit

    /**
     * @param array $description
     * @param int $mode
     * @return bool
     */
    public static function checkPluginDescription(array $description, int $mode = CHECK_ALL): bool {
        return isset($description["name"]) && is_string($description["name"]) &&
            isset($description["api"]) && in_array($description["api"], self::ALLOWED_APIS) &&
            isset($description["author"]) && $description["author"] == "VixikHD" &&
            isset($description["description"]) && is_string($description["description"]) && strlen($description["description"]) > 4 &&
            isset($description["version"]) && is_string($description["version"]);
    }
}