<?php

declare(strict_types=1);

namespace Gado\AirBridgePhpSdk\Tests\Unit\Requests;

use DateTimeImmutable;
use Gado\AirBridgePhpSdk\TrackingLink\Dtos\TrackingLinkListFilter;
use Gado\AirBridgePhpSdk\TrackingLink\Requests\ListTrackingLinksRequest;
use PHPUnit\Framework\Attributes\CoversClass;
use PHPUnit\Framework\Attributes\Test;
use PHPUnit\Framework\TestCase;

#[CoversClass(ListTrackingLinksRequest::class)]
final class ListTrackingLinksRequestTest extends TestCase
{
    #[Test()]
    public function testResolveEndpointReturnEmptyString(): void
    {
        $filter = new TrackingLinkListFilter()
            ->from(new DateTimeImmutable())
            ->to(new DateTimeImmutable());

        $listTrackingLinksRequest = new ListTrackingLinksRequest($filter);
        $this->assertSame('', $listTrackingLinksRequest->resolveEndpoint());
    }
    
    #[Test()]
    public function testDefaultQueryReturnArray(): void
    {
        $filter = new TrackingLinkListFilter()
            ->from(new DateTimeImmutable('2024-01-01'))
            ->to(new DateTimeImmutable('2024-01-31'));
       
        $listTrackingLinksRequest = new ListTrackingLinksRequest($filter);
        $queryParams = $listTrackingLinksRequest->defaultQuery();
        $this->assertIsArray($queryParams);
        $this->assertSame(
            [
                'from' => '2024-01-01',
                'to' => '2024-01-31'
            ],
            $queryParams
        );
    } 
}
