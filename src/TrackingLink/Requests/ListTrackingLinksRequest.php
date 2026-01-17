<?php

declare(strict_types=1);

namespace Gado\AirBridgePhpSdk\TrackingLink\Requests;

use Gado\AirBridgePhpSdk\TrackingLink\Dtos\TrackingLinkListFilter;
use Saloon\Contracts\Body\HasBody;
use Saloon\Enums\Method;
use Saloon\Http\Request;
use Saloon\Traits\Body\HasJsonBody;

final class ListTrackingLinksRequest extends Request implements HasBody
{
    use HasJsonBody;

    protected Method $method = Method::GET;

    public function __construct(private TrackingLinkListFilter $filter)
    {
    }

    public function resolveEndpoint(): string
    {
        return '';
    }

    public function defaultQuery(): array
    {
        return $this->filter->getQueryParams();
    }
}
