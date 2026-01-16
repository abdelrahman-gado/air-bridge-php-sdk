<?php

declare(strict_types=1);

namespace Gado\AirBridgePhpSdk\TrackingLink\Requests;

use Gado\AirBridgePhpSdk\TrackingLink\Dtos\TrackingLink;
use Saloon\Contracts\Body\HasBody;
use Saloon\Enums\Method;
use Saloon\Http\Request;
use Saloon\Traits\Body\HasJsonBody;

class CreateTrackingLinkRequest extends Request implements HasBody
{
    use HasJsonBody;

    protected Method $method = Method::POST;

    public function __construct(protected TrackingLink $dto)
    {
    }

    public function resolveEndpoint(): string
    {
        return '';
    }

    public function defaultBody(): array
    {
        return $this->dto->build();
    }
}
