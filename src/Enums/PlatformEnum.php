<?php

declare(strict_types=1);

namespace Gado\AirBridgePhpSdk\Enums;

enum PlatformEnum: string
{
    case ANDROID = 'android';
    case IOS = 'ios';
    case DESKTOP = 'desktop';
}