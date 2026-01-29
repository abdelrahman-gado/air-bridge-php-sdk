<?php

declare(strict_types= 1);

namespace Gado\AirBridgePhpSdk\Tests\Requests;

use Gado\AirBridgePhpSdk\TrackingLink\Requests\GetSpecificTrackingLinkRequest;
use PHPUnit\Framework\Attributes\CoversClass;
use PHPUnit\Framework\Attributes\Test;
use PHPUnit\Framework\TestCase;

#[CoversClass(GetSpecificTrackingLinkRequest::class)]
final class GetSpecificTrackingLinkRequestTest extends TestCase
{
    #[Test()]
    public function testResolveEndpointReturnStringWithTrackingLinkId(): void
    {
        $id = 123;
        $request = new GetSpecificTrackingLinkRequest($id);
        $this->assertSame('/123', $request->resolveEndpoint());
    }
}
