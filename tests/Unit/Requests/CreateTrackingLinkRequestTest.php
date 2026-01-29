<?php

declare(strict_types=1);

namespace Gado\AirBridgePhpSdk\Tests\Unit\Requests;

use Gado\AirBridgePhpSdk\TrackingLink\Dtos\TrackingLink;
use Gado\AirBridgePhpSdk\TrackingLink\Requests\CreateTrackingLinkRequest;
use PHPUnit\Framework\Attributes\CoversClass;
use PHPUnit\Framework\Attributes\Test;
use PHPUnit\Framework\TestCase;

#[CoversClass(CreateTrackingLinkRequest::class)]
final class CreateTrackingLinkRequestTest extends TestCase
{
    #[Test()]
    public function testResolveEndpointReturnEmptyString(): void
    {
        $trackingLink = new TrackingLink();
        $request = new CreateTrackingLinkRequest($trackingLink);
        $this->assertSame('', $request->resolveEndpoint());
    }

    #[Test()]
    public function testDefaultBodyReturnArray(): void
    {
        $trackingLink = new TrackingLink();
        $request = new CreateTrackingLinkRequest($trackingLink);
        $body = $request->defaultBody();
        $this->assertIsArray($body);
        $this->assertEquals(
            [
                'deeplinkOption' => [
                    'showAlertForInitialDeepLinkingIssue' => false,
                ],
            ],
            $body
        );
    }
}
