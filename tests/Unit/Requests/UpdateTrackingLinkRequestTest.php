<?php

declare(strict_types=1);

namespace Gado\AirBridgePhpSdk\Tests\Requests;

use Gado\AirBridgePhpSdk\Enums\IdTypeEnum;
use Gado\AirBridgePhpSdk\TrackingLink\Dtos\TrackingLinkUpdatePayload;
use Gado\AirBridgePhpSdk\TrackingLink\Requests\UpdateTrackingLinkRequest;
use PHPUnit\Framework\Attributes\CoversClass;
use PHPUnit\Framework\Attributes\Test;
use PHPUnit\Framework\TestCase;

#[CoversClass(UpdateTrackingLinkRequest::class)]
final class UpdateTrackingLinkRequestTest extends TestCase
{
    #[Test]
    public function testResolveEndpointMethodReturnsCorrectEndpoint(): void
    {
        $updatePayloadDto = new TrackingLinkUpdatePayload()
            ->idType(IdTypeEnum::ID)
            ->title('title')
            ->description('description')
            ->imageUrl('https://example.com/image.png');
        
        $request = new UpdateTrackingLinkRequest('235', $updatePayloadDto);
        $this->assertIsString($request->resolveEndpoint());
        $this->assertSame('/235/og-tag', $request->resolveEndpoint());
    }
    
    #[Test]
    public function testDefaultBodyReturnsArrayFromDtoBuildMethod(): void
    {
        $updatePayloadDto = new TrackingLinkUpdatePayload()
            ->idType(IdTypeEnum::ID)
            ->title('title')
            ->description('description')
            ->imageUrl('https://example.com/image.png');
        
        $request = new UpdateTrackingLinkRequest('234', $updatePayloadDto);
        $body = $request->defaultBody();
        
        $this->assertIsArray($body);
        $this->assertSame(
            $updatePayloadDto->build(),
            $body
        );
    }
}
