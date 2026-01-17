<?php

declare(strict_types=1);

namespace Gado\AirBridgePhpSdk\TrackingLink\Requests;

use Saloon\Enums\Method;
use Saloon\Http\Request;

final class GetSpecificTrackingLinkRequest extends Request
{
    protected Method $method = Method::GET;

    public function __construct(private int $trackingLinkId)
    {
    }

    public function resolveEndpoint(): string
    {
        return "/{$this->trackingLinkId}";
    }
}
