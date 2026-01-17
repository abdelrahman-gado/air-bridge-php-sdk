<?php

declare(strict_types=1);

namespace Gado\AirBridgePhpSdk\Tests\Unit;

use DateTimeImmutable;
use Gado\AirBridgePhpSdk\TrackingLink\Dtos\TrackingLink;
use Gado\AirBridgePhpSdk\TrackingLink\Dtos\TrackingLinkListFilter;
use Gado\AirBridgePhpSdk\TrackingLink\Requests\CreateTrackingLinkRequest;
use Gado\AirBridgePhpSdk\TrackingLink\Requests\GetSpecificTrackingLinkRequest;
use Gado\AirBridgePhpSdk\TrackingLink\Requests\ListTrackingLinksRequest;
use Gado\AirBridgePhpSdk\TrackingLink\TrackingLinkApi;
use PHPUnit\Framework\Attributes\CoversClass;
use PHPUnit\Framework\Attributes\Test;
use PHPUnit\Framework\TestCase;
use Saloon\Http\Auth\TokenAuthenticator;
use Saloon\Http\Faking\MockClient;
use Saloon\Http\Faking\MockResponse;

#[CoversClass(TrackingLinkApi::class)]
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

    #[Test()]
    public function testGetSpecificTrackingLinkByIdIsReturningATrackingLink(): void
    {
        $trackingLinkApiMock = $this->createMock(TrackingLinkApi::class);
        $trackingLink = new TrackingLink();
        $trackingLinkApiMock->expects($this->once())
            ->method('getSpecificTrackingLink');

        $trackingLinkApiMock->getSpecificTrackingLink(123);
    }

    #[Test()]
    public function testGetSpecificTrackingLinkByIdReturnsATrackingLink(): void
    {
        $mockClient = new MockClient([
            GetSpecificTrackingLinkRequest::class => MockResponse::make(
                body: [
                    'data' => [
                        "company" => null,
                        "shortId" => "ri4lnp",
                        "shortUrl" => "https://go.ab180.co/ri4lnp",
                        "createdAt" => "2023-01-01T00:00:00+09:00",
                        "channelName" => "my-channel",
                        "channelType" => "custom",
                        "deeplinkUrl" => null,
                        "deeplinkOption" => [
                            "showAlertForInitialDeeplinkingIssue" => false
                        ],
                        "fallbackPaths" => [
                            "ios" => "itunes-appstore",
                            "option" => [
                                "iosCustomProductPageId" => null
                            ],
                            "android" => "google-play",
                            "desktop" => "https://airbridge.io"
                        ],
                    ],
                ],
                status: 200,
                headers: ['Content-Type' => 'application/json']
            )
        ]);


        $this->trackingLinkApi->withMockClient($mockClient);
        $this->trackingLinkApi->getSpecificTrackingLink(10000)->body();
        $mockClient->assertSent(GetSpecificTrackingLinkRequest::class);
    }

    #[Test()]
    public function testListTrackingLinksCallingListTrackingLinksMethod(): void
    {
        $filters = new TrackingLinkListFilter()
            ->from(new DateTimeImmutable())
            ->to(new DateTimeImmutable());

        $trackingLinkApiMock = $this->createMock(TrackingLinkApi::class);
        $trackingLinkApiMock->expects($this->once())
            ->method('listTrackingLinks')
            ->with($filters);

        $trackingLinkApiMock->listTrackingLinks($filters);
    }

    public function testListTrackingLinksReturnAListOfTrackingLinks(): void
    {
        $mockClient = new MockClient([
            ListTrackingLinksRequest::class => MockResponse::make(
                body: [
                    'data' => [
                        "totalCount" => 1,
                        "trackingLinks" => [
                            [
                                "id" => "10001",
                            ]
                        ]
                    ],
                ],
                status: 200,
                headers: ['Content-Type' => 'application/json']
            )
        ]);

        $filter = new TrackingLinkListFilter()
                ->from(new DateTimeImmutable())
                ->to(new DateTimeImmutable());

        $this->trackingLinkApi->withMockClient($mockClient);
        $this->trackingLinkApi->listTrackingLinks($filter)->body();
        $mockClient->assertSent(ListTrackingLinksRequest::class);
    }
}
