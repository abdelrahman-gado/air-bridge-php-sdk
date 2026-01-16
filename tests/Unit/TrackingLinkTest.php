<?php

declare(strict_types=1);

namespace Gado\AirBridgePhpSdk\Tests\Unit;

use Gado\AirBridgePhpSdk\Enums\OgTagWebsiteCrawlEnum;
use Gado\AirBridgePhpSdk\Enums\PlatformEnum;
use Gado\AirBridgePhpSdk\TrackingLink\Dtos\TrackingLink;
use InvalidArgumentException;
use PHPUnit\Framework\Attributes\Test;
use PHPUnit\Framework\TestCase;
use stdClass;
use TypeError;

final class TrackingLinkTest extends TestCase
{
    private TrackingLink $trackingLink;

    protected function setUp(): void
    {
        $this->trackingLink = new TrackingLink();
    }

    #[Test()]
    public function testChannelMethodTakesStringAndReturnCurrentObject(): void
    {
        $this->assertSame($this->trackingLink, $this->trackingLink->channel('test'));
    }

    #[Test()]
    public function testChannelMethodTakeStringArgumentsOnly(): void
    {
        $this->expectException(TypeError::class);
        $this->trackingLink->channel(123);
        
        $this->expectException(TypeError::class);
        $this->trackingLink->channel(null);

        $this->expectException(TypeError::class);
        $this->trackingLink->channel(false);
        
        $this->expectException(TypeError::class);
        $this->trackingLink->channel(new stdClass());
    }


    #[Test()]
    public function testDeepLinkUrlMethodTakesStringAndReturnCurrentObject()
    {
        $this->assertSame($this->trackingLink, $this->trackingLink->deepLinkUrl('https://hello.com/test'));
    }
     
    #[Test()]
    public function testDeepLinkUrlMethodTakeStringArgumentsOnly(): void
    {
        $this->expectException(TypeError::class);
        $this->trackingLink->deepLinkUrl(123);
        
        $this->expectException(TypeError::class);
        $this->trackingLink->deepLinkUrl(null);

        $this->expectException(TypeError::class);
        $this->trackingLink->deepLinkUrl(false);
        
        $this->expectException(TypeError::class);
        $this->trackingLink->deepLinkUrl(new stdclass());
    }

    #[Test()]
    public function testAndroidFallbackPathMethodTakesStringAndReturnCurrentObject()
    {
        $this->assertSame(
            $this->trackingLink,
            $this->trackingLink->androidFallbackPath('https://play.google.com/test')
        );
    }
    
    #[Test()]
    public function testAndroidFallbackPathMethodTakeStringArgumentsOnly(): void
    {
        $this->expectException(TypeError::class);
        $this->trackingLink->androidFallbackPath(123);
        
        $this->expectException(TypeError::class);
        $this->trackingLink->androidFallbackPath(null);

        $this->expectException(TypeError::class);
        $this->trackingLink->androidFallbackPath(false);
        
        $this->expectException(TypeError::class);
        $this->trackingLink->androidFallbackPath(new stdClass());
    }

    #[Test()]
    public function testIosFallbackPathMethodTakesStringAndReturnCurrentObject()
    {
        $this->assertSame(
            $this->trackingLink,
            $this->trackingLink->iosFallbackPath('https://apps.apple.com/test')
        );
    }

    #[Test()]
    public function testIosFallbackPathMethodTakeStringArgumentsOnly(): void
    {
        $this->expectException(TypeError::class);
        $this->trackingLink->iosFallbackPath(123);
        
        $this->expectException(TypeError::class);
        $this->trackingLink->iosFallbackPath(null);

        $this->expectException(TypeError::class);
        $this->trackingLink->iosFallbackPath(false);
        
        $this->expectException(TypeError::class);
        $this->trackingLink->iosFallbackPath(new stdClass());
    }

    #[Test()]
    public function testDesktopFallbackPathMethodTakesStringAndReturnCurrentObject()
    {
        $this->assertSame(
            $this->trackingLink,
            $this->trackingLink->desktopFallbackPath('https://desktop.example.com/test')
        );
    }

    #[Test()]
    public function testDesktopFallbackPathMethodTakeStringArgumentsOnly(): void
    {
        $this->expectException(TypeError::class);
        $this->trackingLink->desktopFallbackPath(123);
        
        $this->expectException(TypeError::class);
        $this->trackingLink->desktopFallbackPath(null);

        $this->expectException(TypeError::class);
        $this->trackingLink->desktopFallbackPath(false);
        
        $this->expectException(TypeError::class);
        $this->trackingLink->desktopFallbackPath(new stdClass());
    }

    #[Test()]
    public function testAlertForInitialDeepLinkingIssueMethodTakesStringAndReturnCurrentObject()
    {
        $this->assertSame(
            $this->trackingLink,
            $this->trackingLink->alertForInitialDeepLinkingIssue()
        );
    }

    #[Test()]
    public function testCustomShortIdMethodMethodTakesStringAndReturnCurrentObject()
    {
        $this->assertSame(
            $this->trackingLink,
            $this->trackingLink->customShortId('aaa123')
        );
    }
    
    #[Test()]
    public function testCustomShortIdMethodTakeStringArgumentsOnly(): void
    {
        $this->expectException(TypeError::class);
        $this->trackingLink->customShortId(123);
        
        $this->expectException(TypeError::class);
        $this->trackingLink->customShortId(null);

        $this->expectException(TypeError::class);
        $this->trackingLink->customShortId(false);
        
        $this->expectException(TypeError::class);
        $this->trackingLink->customShortId(new stdClass());
    }
     
    #[Test()]
    public function testCustomShortIdThrowsAnInvalidArgumentWhenArgumentExceed45Character(): void
    {
        $this->expectException(InvalidArgumentException::class);
        $this->trackingLink->customShortId('a'.str_repeat('b', 45));
    }
    
    #[Test()]
    public function testCustomShortIdThrowsAnInvalidArgumentWhenArgumentContainsNonAlphaNumericCharacters(): void
    {
        $this->expectException(InvalidArgumentException::class);
        $this->trackingLink->customShortId('@@#####');
    }


    #[Test()]
    public function testOgTagTitleMethodTakesStringAndReturnCurrentObject()
    {
        $this->assertSame(
            $this->trackingLink,
            $this->trackingLink->ogTagTitle('Test Title')
        );
    }
    
    #[Test()]
    public function testOgTagTitleMethodTakeStringArgumentsOnly(): void
    {
        $this->expectException(TypeError::class);
        $this->trackingLink->ogTagTitle(123);
        
        $this->expectException(TypeError::class);
        $this->trackingLink->ogTagTitle(null);

        $this->expectException(TypeError::class);
        $this->trackingLink->ogTagTitle(false);
        
        $this->expectException(TypeError::class);
        $this->trackingLink->ogTagTitle(new stdClass());
    }
    
    #[Test()]
    public function testOgTagDescriptionMethodTakesStringAndReturnCurrentObject()
    {
        $this->assertSame(
            $this->trackingLink,
            $this->trackingLink->ogTagDescription('Test Description')
        );
    }
    
    #[Test()]
    public function testOgTagDescriptionMethodTakeStringArgumentsOnly(): void
    {
        $this->expectException(TypeError::class);
        $this->trackingLink->ogTagDescription(123);
        
        $this->expectException(TypeError::class);
        $this->trackingLink->ogTagDescription(null);

        $this->expectException(TypeError::class);
        $this->trackingLink->ogTagDescription(false);
        
        $this->expectException(TypeError::class);
        $this->trackingLink->ogTagDescription(new stdClass());
    }
     
    #[Test()]
    public function testOgTagImageUrlMethodTakesStringAndReturnCurrentObject()
    {
        $this->assertSame(
            $this->trackingLink,
            $this->trackingLink->ogTagImageUrl('https://example.com/image.jpg')
        );
    }
    
    #[Test()]
    public function testOgTagImageUrlMethodTakeStringArgumentsOnly(): void
    {
        $this->expectException(TypeError::class);
        $this->trackingLink->ogTagImageUrl(123);
        
        $this->expectException(TypeError::class);
        $this->trackingLink->ogTagImageUrl(null);

        $this->expectException(TypeError::class);
        $this->trackingLink->ogTagImageUrl(false);
        
        $this->expectException(TypeError::class);
        $this->trackingLink->ogTagImageUrl(new stdClass());
    }
    
    #[Test()]
    public function testOgTagWebsiteCrawlMethodTakesEnumValueAndReturnCurrentObject()
    {
        $this->assertSame(
            $this->trackingLink,
            $this->trackingLink->ogTagWebsiteCrawl(OgTagWebsiteCrawlEnum::DESKTOP)
        );
    }
    
    #[Test()]
    public function testOgTagWebsiteCrawlMethodTakeEnumValueArgumentsOnly(): void
    {
        $this->expectException(TypeError::class);
        $this->trackingLink->ogTagWebsiteCrawl(123);
        
        $this->expectException(TypeError::class);
        $this->trackingLink->ogTagWebsiteCrawl(null);

        $this->expectException(TypeError::class);
        $this->trackingLink->ogTagWebsiteCrawl(false);

        $this->expectException(TypeError::class);
        $this->trackingLink->ogTagWebsiteCrawl(new stdClass());
    }
    
    #[Test()]
    public function testUseDefaultOgTagMethodReturnsCurrentObject()
    {
        $this->assertSame(
            $this->trackingLink,
            $this->trackingLink->useDefaultOgTag()
        );
    }
    
    #[Test()]
    public function testBuildReturnArrayWithRealData(): void
    { 
        $actual = $this->trackingLink
            ->channel('test')
            ->androidFallbackPath('https://play.google.com')
            ->iosFallbackPath('https://appstore.apple.com')
            ->desktopFallbackPath('https://desktop.desktop.com')
            ->deepLinkUrl('https://example.com/123')
            ->alertForInitialDeepLinkingIssue()
            ->customShortId('test')
            ->ogTagTitle('Test Title')
            ->ogTagDescription('Test Description')
            ->ogTagImageUrl('https://example.com/image.jpg')
            ->ogTagWebsiteCrawl(OgTagWebsiteCrawlEnum::DESKTOP)
            ->useDefaultOgTag()
            ->build();

        $expected = [
            'channel' => 'test',
            'deeplinkUrl' => 'https://example.com/123',
            'customShortId' => 'test',
            'deeplinkOption' => [
                'showAlertForInitialDeepLinkingIssue' => true,
            ],
            'fallbackPaths' => [
                PlatformEnum::ANDROID->value => 'https://play.google.com',
                PlatformEnum::IOS->value => 'https://appstore.apple.com',
                PlatformEnum::DESKTOP->value => 'https://desktop.desktop.com',
            ],
            'ogTag' => [
                'title' => 'Test Title',
                'description' => 'Test Description',
                'imageUrl' => 'https://example.com/image.jpg',
                'websiteCrawl' => OgTagWebsiteCrawlEnum::DESKTOP->value,
                'useDefault' => true,
            ],
        ];

        $this->assertEquals($expected, $actual);
    }

    #[Test()]
    public function testBuildWithNullableData(): void
    { 
        $actual = $this->trackingLink
            ->androidFallbackPath('https://play.google.com')
            ->desktopFallbackPath('https://desktop.desktop.com')
            ->deepLinkUrl('https://example.com/123')
            ->customShortId('test')
            ->ogTagTitle('Test Title')
            ->ogTagWebsiteCrawl(OgTagWebsiteCrawlEnum::DESKTOP)
            ->useDefaultOgTag()
            ->build();

        $expected = [
            'deeplinkUrl' => 'https://example.com/123',
            'customShortId' => 'test',
            'deeplinkOption' => [
                'showAlertForInitialDeepLinkingIssue' => false,
            ],
            'fallbackPaths' => [
                PlatformEnum::ANDROID->value => 'https://play.google.com',
                PlatformEnum::DESKTOP->value => 'https://desktop.desktop.com',
            ],
            'ogTag' => [
                'title' => 'Test Title',
                'websiteCrawl' => OgTagWebsiteCrawlEnum::DESKTOP->value,
                'useDefault' => true,
            ],
        ];

        $this->assertEquals($expected, $actual);
    }

    #[Test()]
    public function testBuildWithNullableDataAndDontAlertForInitalDeepLinkingIssue(): void
    { 
        $actual = $this->trackingLink
            ->androidFallbackPath('https://play.google.com')
            ->desktopFallbackPath('https://desktop.desktop.com')
            ->alertForInitialDeepLinkingIssue()
            ->deepLinkUrl('https://example.com/123')
            ->customShortId('test')
            ->ogTagTitle('Test Title')
            ->ogTagWebsiteCrawl(OgTagWebsiteCrawlEnum::DESKTOP)
            ->useDefaultOgTag()
            ->build();

        $expected = [
            'deeplinkUrl' => 'https://example.com/123',
            'customShortId' => 'test',
            'deeplinkOption' => [
                'showAlertForInitialDeepLinkingIssue' => true,
            ],
            'fallbackPaths' => [
                PlatformEnum::ANDROID->value => 'https://play.google.com',
                PlatformEnum::DESKTOP->value => 'https://desktop.desktop.com',
            ],
            'ogTag' => [
                'title' => 'Test Title',
                'websiteCrawl' => OgTagWebsiteCrawlEnum::DESKTOP->value,
                'useDefault' => true,
            ],
        ];

        $this->assertEquals($expected, $actual);
    }
}
