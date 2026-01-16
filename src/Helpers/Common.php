<?php

declare(strict_types=1);

namespace Gado\AirBridgePhpSdk\Helpers;

class Common
{
    public const string BASE_CONFIGURATION_PATH = __DIR__ . '/../configuration.php';

    public static function config(?string $configName = null): mixed
    {
        $configuration = require self::BASE_CONFIGURATION_PATH;
        if ($configName === null) {
            return null;
        }

        $requiredConfigs = explode('.', $configName);
        return array_reduce($requiredConfigs, function ($subConfigArray, $key) use ($configuration) {
            if (!isset($subConfigArray[$key])) {
                return null;
            }

            return $subConfigArray[$key];
        }, $configuration);
    }
}
