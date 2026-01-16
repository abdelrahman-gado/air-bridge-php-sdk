<?php

declare(strict_types=1);

namespace Gado\AirBridgePhpSdk\TrackingLink\Dtos;

use Gado\AirBridgePhpSdk\Enums\OgTagWebsiteCrawlEnum;
use Gado\AirBridgePhpSdk\Enums\PlatformEnum;
use InvalidArgumentException;

class TrackingLink
{
    private ?string $channel = null;
    private ?string $deepLinkUrl = null;
    private ?string $androidFallbackPath = null;
    private ?string $iosFallbackPath = null;
    private ?string $desktopFallbackPath = null;
    private bool $alertForInitialDeepLinkingIssue = false;
    private ?string $customShortId = null;
    private ?string $ogTagTitle = null;
    private ?string $ogTagDescription = null;
    private ?string $ogTagImageUrl = null;
    private ?OgTagWebsiteCrawlEnum $ogTagWebsiteCrawl = null;
    private ?bool $ogTagUseDefault = null;

    public function __construct()
    {
    }

    public function channel(string $channel): static
    {
        $this->channel = $channel;
        return $this;
    }

    public function deepLinkUrl(string $url): static
    {
        $this->deepLinkUrl = $url;
        return $this;
    }

    public function androidFallbackPath(string $path): static
    {
        $this->androidFallbackPath = $path;
        return $this;
    }

    public function iosFallbackPath(string $path): static
    {
        $this->iosFallbackPath = $path;
        return $this;
    }

    public function desktopFallbackPath(string $path): static
    {
        $this->desktopFallbackPath = $path;
        return $this;
    }

    public function alertForInitialDeepLinkingIssue(): static
    {
        $this->alertForInitialDeepLinkingIssue = true;
        return $this;
    }

    public function customShortId(string $customShortId): static
    {
        if (strlen($customShortId) > 45 || preg_match('/[^a-z0-9-_]/', $customShortId)) {
            throw new InvalidArgumentException('Custom short ID must be less than 45 characters and contain only alphanumeric characters, hyphens, or underscores.');
        }

        $this->customShortId = $customShortId;
        return $this;
    }

    public function ogTagTitle(string $ogTagTitle): static
    {
        $this->ogTagTitle = $ogTagTitle;
        return $this;
    }

    public function ogTagDescription(string $ogTagDescription): static
    {
        $this->ogTagDescription = $ogTagDescription;
        return $this;
    }

    public function ogTagImageUrl(string $ogTagImageUrl): static
    {
        $this->ogTagImageUrl = $ogTagImageUrl;
        return $this;
    }

    public function ogTagWebsiteCrawl(OgTagWebsiteCrawlEnum $ogTagWebsiteCrawl): static
    {
        $this->ogTagWebsiteCrawl = $ogTagWebsiteCrawl;
        return $this;
    }

    public function useDefaultOgTag(): static
    {
        $this->ogTagUseDefault = true;
        return $this;
    }

    public function build(): array
    {
        return array_filter([
            'channel' => $this->channel,
            'deeplinkUrl' => $this->deepLinkUrl,
            'customShortId' => $this->customShortId,
            'deeplinkOption' => [
                'showAlertForInitialDeepLinkingIssue' => $this->alertForInitialDeepLinkingIssue,
            ],
            'fallbackPaths' => array_filter([
                PlatformEnum::ANDROID->value => $this->androidFallbackPath,
                PlatformEnum::IOS->value => $this->iosFallbackPath,
                PlatformEnum::DESKTOP->value => $this->desktopFallbackPath,
            ], static fn($value) => $value !== null),

            'ogTag' => array_filter([
                'title' => $this->ogTagTitle,
                'description' => $this->ogTagDescription,
                'imageUrl' => $this->ogTagImageUrl,
                'websiteCrawl' => $this->ogTagWebsiteCrawl?->value,
                'useDefault' => $this->ogTagUseDefault,
            ], static fn($value) => $value !== null),

        ], static fn($value) => $value !== null && $value !== []);
    }
}
