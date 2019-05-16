<?php

declare(strict_types=1);

namespace vixikhd\pluginmaker\skeleton;

class SkeletonData {

    public const DEFAULT_PLUGIN = [
        '<?php',
        '',
        'declare(strict_types=1);',
        '',
        'namespace {%author}\{%name};',
        '',
        'use pocketmine\event\Listener;',
        'use pocketmine\plugin\PluginBase;',
        '',
        'class {%Name} extends PluginBase implements Listener {',
        '{%pluginData}',
        '}'
    ];
}