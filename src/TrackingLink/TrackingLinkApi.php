<?php

declare(strict_types=1);

namespace Gado\AirBridgePhpSdk\TrackingLink;

use Gado\AirBridgePhpSdk\AirBridgeConnector;
use Gado\AirBridgePhpSdk\Enums\LanguageEnum;
use Gado\AirBridgePhpSdk\Helpers\Common;
use Gado\AirBridgePhpSdk\TrackingLink\Dtos\TrackingLink;
use Gado\AirBridgePhpSdk\TrackingLink\Dtos\TrackingLinkListFilter;
use Gado\AirBridgePhpSdk\TrackingLink\Dtos\TrackingLinkUpdatePayload;
use Gado\AirBridgePhpSdk\TrackingLink\Requests\CreateTrackingLinkRequest;
use Gado\AirBridgePhpSdk\TrackingLink\Requests\GetSpecificTrackingLinkRequest;
use Gado\AirBridgePhpSdk\TrackingLink\Requests\ListTrackingLinksRequest;
use Gado\AirBridgePhpSdk\TrackingLink\Requests\UpdateTrackingLinkRequest;
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

    public function getSpecificTrackingLink(int $id): Response
    {
        return $this->send(new GetSpecificTrackingLinkRequest($id));
    }
    
    public function listTrackingLinks(TrackingLinkListFilter $filters): Response
    {
        return $this->send(new ListTrackingLinksRequest($filters));
    }
    
    public function updateTrackingLink(string $id, TrackingLinkUpdatePayload $trackingLinkPayload): Response
    {
        return $this->send(new UpdateTrackingLinkRequest($id, $trackingLinkPayload));
    }
}
