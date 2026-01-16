<?php

declare(strict_types=1);

namespace Gado\AirBridgePhpSdk\Tests\Unit;

use Gado\AirBridgePhpSdk\TrackingLink\Dtos\TrackingLink;
use Gado\AirBridgePhpSdk\TrackingLink\Requests\CreateTrackingLinkRequest;
use Gado\AirBridgePhpSdk\TrackingLink\TrackingLinkApi;
use PHPUnit\Framework\Attributes\Test;
use PHPUnit\Framework\TestCase;
use Saloon\Http\Auth\TokenAuthenticator;
use Saloon\Http\Faking\MockClient;
use Saloon\Http\Faking\MockResponse;

final class TrackingLinkApiTest extends TestCase
{
    private TrackingLinkApi $trackingLinkApi;

    protected function setUp(): void
    {
        $this->trackingLinkApi = new TrackingLinkApi('test_token');
        MockClient::destroyGlobal();
    }

    #[Test()]
    public function testResolveBaseUrlReturnString(): void
    {
        $this->assertSame(
            'https://api.airbridge.io/v1/tracking-links',
            $this->trackingLinkApi->resolveBaseUrl()
        );
    }

    #[Test()]
    public function testDefaultHeadersReturnAnArray(): void
    {
        $this->assertSame(
            ['Accept-Language' => 'en', 'Content-Type' => 'application/json'],
            $this->trackingLinkApi->defaultHeaders()
        );
    }

    #[Test()]
    public function testDefaultAuthReturnATokenAuthenticatorObject(): void
    {
        $this->assertInstanceOf(TokenAuthenticator::class, $this->trackingLinkApi->defaultAuth());
    }
    
    #[Test()]
    public function testCreateTrackingLinkIsCreatingATrackingLink(): void
    {
        $trackingLinkApiMock = $this->createMock(TrackingLinkApi::class);
        $trackingLink = new TrackingLink();
        $trackingLinkApiMock->expects($this->once())
            ->method('createTrackingLink')
            ->with($trackingLink);
        $trackingLinkApiMock->createTrackingLink($trackingLink);
    }
    

    #[Test()]
    public function testCreateTrackingLinkReturnsATrackingLink(): void
    {
        $mockClient = new MockClient([
            CreateTrackingLinkRequest::class => MockResponse::make(
                body: [
                    'data' => [
                        'trackingLink' => [
                            'id' => 10000,
                            'shortId' => 'abc123',
                            'shortUrl' => 'http://abr.ge/abc123',
                            'channelType' => 'custom',
                            'trackingTemplateId' => '706f9839a7b50d87ab917dbb1b9fa7f3'
                        ]
                    ]
                ],
                status: 200,
                headers: ['Content-Type' => 'application/json']
            )
        ]);
        
        $trackingLink = new TrackingLink()
            ->channel('custom')
            ->deepLinkUrl('https://example.com')
            ->customShortId('abc123');

        $this->trackingLinkApi->withMockClient($mockClient);
        $this->trackingLinkApi->createTrackingLink($trackingLink)->body();
        $mockClient->assertSent(CreateTrackingLinkRequest::class);
    }
}
