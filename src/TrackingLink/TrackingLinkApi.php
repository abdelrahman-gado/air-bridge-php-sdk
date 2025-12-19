<?php

declare(strict_types=1);

namespace Gado\AirBridgePhpSdk\TrackingLink;

use Gado\AirBridgePhpSdk\AirBridgeConnector;
use Gado\AirBridgePhpSdk\Enums\LanguageEnum;

class TrackingLinkApi extends AirBridgeConnector
{
    public function __construct(
        protected string $token,
        protected LanguageEnum $language,
    ) {
        parent::__construct($token, $language);
    }
    
    public function resolveBaseUrl(): string
    {
        return parent::resolveBaseUrl() . config('trackingLinks.basePath');
    }
}