<?php

declare(strict_types=1);

namespace Gado\AirBridgePhpSdk\TrackingLink\Requests;

use Gado\AirBridgePhpSdk\TrackingLink\Dtos\TrackingLinkUpdatePayload;
use Saloon\Contracts\Body\HasBody;
use Saloon\Enums\Method;
use Saloon\Http\Request;
use Saloon\Traits\Body\HasJsonBody;

class UpdateTrackingLinkRequest extends Request implements HasBody
{
    use HasJsonBody;

    protected Method $method = Method::PATCH;

    public function __construct(
        protected string $id,
        protected TrackingLinkUpdatePayload $dto
    ) {
    }

    public function resolveEndpoint(): string
    {
        return '/' . $this->id . '/og-tag';
    }

    public function defaultBody(): array
    {
        return $this->dto->build();
    }
}
