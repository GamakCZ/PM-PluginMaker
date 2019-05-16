<?php

declare(strict_types=1);

namespace vixikhd\pluginmaker;

use vixikhd\pluginmaker\skeleton\SkeletonData;

/**
 * Class PluginMaker
 * @package vixikhd\pluginmaker
 */
class PluginMaker {

    public const TABULATOR = "   ";

    /** @var array $usedProject */
    public static $usedProject;

    public function __construct() {
        if (!class_exists(SkeletonData::class)) {
            $file = null;
            try {
                include ($file = str_replace("PluginMaker.php", "skeleton" . DIRECTORY_SEPARATOR . "SkeletonData.php", __FILE__));
            }
            catch (\Exception $exception) {
                var_dump($file);
            }
        }
    }

    /**
     * @param string $file
     * @param bool $override
     * @throws InvalidProjectException
     */
    public function loadJson(string $file, bool $override = true) {
        if(!file_exists($file)) {
            throw new InvalidProjectException("Json project $file wasn't found!");
        }
        if($override || !empty(self::$usedProject)) {
            self::$usedProject = json_decode(file_get_contents($file), true);
            if(!isset(self::$usedProject["skeleton"])) {
                $this->addSkeletonData();
                $this->fixSkeletonData(); // plugin must have valid description
            }
        }
    }

    public function addSkeletonData() {
        self::$usedProject["skeleton"] = implode("\n", SkeletonData::DEFAULT_PLUGIN);
    }

    public function fixSkeletonData() {
        self::$usedProject["skeleton"]= str_replace([
            "{%name}", "{%author}",
            "{%Name}", "{%Author}",
            "{%pluginData}"
        ], [
            $this->getPluginName(), $this->getPluginAuthor(),
            strtolower($this->getPluginName()), strtolower($this->getPluginAuthor()),
            self::TABULATOR . "// code"
        ], self::$usedProject["skeleton"]);
    }

    public function exportProject(): string {
        $time = time();
        $projectDir = getcwd() . DIRECTORY_SEPARATOR . "projects" . DIRECTORY_SEPARATOR . $time . DIRECTORY_SEPARATOR . $this->getPluginName() . DIRECTORY_SEPARATOR;

        if(!is_dir($pathToDir = getcwd() . DIRECTORY_SEPARATOR . "projects" . DIRECTORY_SEPARATOR . $time)) {
            mkdir($pathToDir);
        }
        if(!is_dir($projectDir)) {
            mkdir($projectDir);
        }

        yaml_emit_file($projectDir . "plugin.yml", self::$usedProject["description"]);

        $i = $projectDir;
        foreach ([strtolower($this->getPluginAuthor()), strtolower($this->getPluginName())] as $dir) {
            $i .= $dir . DIRECTORY_SEPARATOR;
            mkdir($i);
        }

        file_put_contents($i, self::$usedProject["skeleton"]);

        $phar = new \Phar($path = $projectDir . "/{$this->getPluginName()}.phar");
        $phar->buildFromDirectory($projectDir);

        return $path;
    }

    /**
     * @return string
     */
    public function getPluginName(): string {
        return self::$usedProject["description"]["name"];
    }

    /**
     * @return string
     */
    public function getPluginDescription(): string {
        return self::$usedProject["description"]["description"];
    }

    /**
     * @return string
     */
    public function getPluginVersion(): string {
        return self::$usedProject["description"]["version"];
    }

    /**
     * @return string
     */
    public function getPluginAuthor(): string {
        return self::$usedProject["description"]["author"];
    }
}