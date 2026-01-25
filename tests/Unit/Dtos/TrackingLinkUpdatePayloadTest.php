<?php

declare(strict_types=1);

namespace Gado\AirBridgePhpSdk\Tests;

use BadMethodCallException;
use Gado\AirBridgePhpSdk\Enums\IdTypeEnum;
use Gado\AirBridgePhpSdk\TrackingLink\Dtos\TrackingLinkUpdatePayload;
use PHPUnit\Framework\Attributes\CoversClass;
use PHPUnit\Framework\Attributes\Test;
use PHPUnit\Framework\TestCase;

#[CoversClass(TrackingLinkUpdatePayload::class)]
final class TrackingLinkUpdatePayloadTest extends TestCase
{
    private TrackingLinkUpdatePayload $trackingLinkUpdatePayload;

    protected function setUp(): void
    {
        $this->trackingLinkUpdatePayload = new TrackingLinkUpdatePayload();
    }

    #[Test()]
    public function testIdTypeMethodTakesIdTypeCaseAndReturnCurrentObject(): void
    {
        $obj = $this->trackingLinkUpdatePayload->idType(IdTypeEnum::ID);
        $this->assertSame($obj, $this->trackingLinkUpdatePayload);
        $this->assertInstanceOf(TrackingLinkUpdatePayload::class, $obj);
    }

    #[Test()]
    public function testTitleMethodTakesAStringAndReturnCurrentObject(): void
    {
        $obj = $this->trackingLinkUpdatePayload->title('Simple title');
        $this->assertSame($obj, $this->trackingLinkUpdatePayload);
        $this->assertInstanceOf(TrackingLinkUpdatePayload::class, $obj);
    }

    #[Test()]
    public function testDescriptionMethodTakesAStringAndReturnCurrentObject(): void
    {
        $obj = $this->trackingLinkUpdatePayload->description('simple description');
        $this->assertSame($obj, $this->trackingLinkUpdatePayload);
        $this->assertInstanceOf(TrackingLinkUpdatePayload::class, $obj);
    }

    #[Test()]
    public function testImageUrlMethodTakesAStringAndReturnCurrentObject(): void
    {
        $obj = $this->trackingLinkUpdatePayload->imageUrl('https://example.com/image.jpg');
        $this->assertSame($obj, $this->trackingLinkUpdatePayload);
        $this->assertInstanceOf(TrackingLinkUpdatePayload::class, $obj);
    }


    #[Test()]
    public function testBuildMethodReturnsArrayWithAllSettedProperties(): void
    {
        $arr = $this->trackingLinkUpdatePayload
            ->idType(IdTypeEnum::ID)
            ->title('Simple title')
            ->description('simple description')
            ->imageUrl('https://example.com/image.jpg')
            ->build();

        $this->assertIsArray($arr);
        $this->assertCount(4, $arr);
        $this->assertEquals(
            [
                'idType' => 'id',
                'title' => 'Simple title',
                'description' => 'simple description',
                'imageUrl' => 'https://example.com/image.jpg',
            ],
            $arr
        );
    }

    #[Test()]
    public function testBuildMethodThrowsBadMethodCallExceptionWhenRequiredTitleMissing(): void
    {
        $this->expectException(BadMethodCallException::class);
        $arr = $this->trackingLinkUpdatePayload
            ->description('simple description')
            ->imageUrl('https://example.com/image.jpg')
            ->build();
    }
    
    #[Test]
    public function testBuildMethodThrowsBadMethodCallExceptionWhenRequiredDescriptionMissing(): void
    {
        $this->expectException(BadMethodCallException::class);
        $arr = $this->trackingLinkUpdatePayload
            ->title('Simple title')
            ->imageUrl('https://example.com/image.jpg')
            ->build();
    }
    
    #[Test]
    public function testBuildMethodThrowsBadMethodCallExceptionWhenRequiredImageUrlMissing(): void
    {
        $this->expectException(BadMethodCallException::class);
        $arr = $this->trackingLinkUpdatePayload
            ->title('Simple title')
            ->description('simple description')
            ->build();
    }
    
    #[Test()]
    public function testBuildMethodThrowsBadMethodCallExceptionWhenNoPropertiesSet(): void
    {
        $this->expectException(BadMethodCallException::class);
        $arr = $this->trackingLinkUpdatePayload
            ->build();
    } 
}
