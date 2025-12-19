<?php

declare(strict_types=1);

if (!function_exists('config')) {
    function config(?string $configName = null): mixed 
    {
        $configuration = require_once __DIR__ . '/../configuration.php';
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

