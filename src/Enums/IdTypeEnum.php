<?php

declare(strict_types=1);

namespace Gado\AirBridgePhpSdk\Enums;

enum IdTypeEnum: string
{
    case ID = 'id';
    case SHORT_ID = 'shortId';
    case TRACKING_TEMPLATE_ID = 'trackingTemplateId';
}
