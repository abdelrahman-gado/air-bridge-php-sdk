<?php

declare(strict_types=1);

namespace Gado\AirBridgePhpSdk\TrackingLink;

use Gado\AirBridgePhpSdk\AirBridgeConnector;
use Gado\AirBridgePhpSdk\Enums\LanguageEnum;
use Gado\AirBridgePhpSdk\Helpers\Common;
use Gado\AirBridgePhpSdk\TrackingLink\Dtos\TrackingLink;
use Gado\AirBridgePhpSdk\TrackingLink\Requests\CreateTrackingLinkRequest;
use Saloon\Http\Response;

class TrackingLinkApi extends AirBridgeConnector
{
    public function __construct(
        protected string $token,
        protected LanguageEnum $language = LanguageEnum::ENGLISH,
    ) {
        parent::__construct($token, $language);
    }

    public function resolveBaseUrl(): string
    {
        return parent::resolveBaseUrl() . Common::config('trackingLinks.basePath');
    }

    public function createTrackingLink(TrackingLink $trackingLink): Response
    {
        return $this->send(new CreateTrackingLinkRequest($trackingLink));
    }
}
