# Air Bridge PHP SDK

[![Latest Version on Packagist][ico-version]][link-packagist]
[![Software License][ico-license]](LICENSE.md)
[![Quality Score][ico-code-quality]][link-code-quality]
[![Total Downloads][ico-downloads]][link-downloads]

A Simple PHP SDK for integrating with the Air Bridge attribution and deep linking platform. This package provides an easy-to-use interface for managing tracking links and attribution data through the Air Bridge API.

**Note: Only the tracking link API is implemented in this package till now.**

## Install

Via Composer

``` bash
$ composer require abdelrahman-gado/air-bridge-php-sdk
```

## Usage
### Create a Tracking Link
```php
use Gado\AirBridgePhpSdk\TrackingLink\TrackingLinkApi;
use Gado\AirBridgePhpSdk\Dto\TrackingLink;

$trackingLinkApi = new TrackingLinkApi('your_bearer_token');

$trackingLink = new TrackingLink()
    ->androidFallbackPath('https://play.google.com')
    ->desktopFallbackPath('https://desktop.desktop.com')
    ->alertForInitialDeepLinkingIssue()
    ->deepLinkUrl('https://example.com/123')
    ->customShortId('test')
    ->ogTagTitle('Test Title')
    ->ogTagWebsiteCrawl(OgTagWebsiteCrawlEnum::DESKTOP)
    ->useDefaultOgTag()
    ->build();

$result = $trackingLinkApi->createTrackingLink($trackingLink);
```

### Update a tracking Link
```php
use Gado\AirBridgePhpSdk\TrackingLink\TrackingLinkApi;
use Gado\AirBridgePhpSdk\Dto\TrackingLinkUpdatePayload;

$trackingLinkApi = new TrackingLinkApi('your_bearer_token');
$trackingLinkUpdateObj = new TrackingLinkUpdatePayload()
    ->idType(IdTypeEnum::ID)
    ->title('Simple title')
    ->description('simple description')
    ->imageUrl('https://example.com/image.jpg')
    ->build();
    
$result = $trackingLinkApi->updateTrackingLink('123', $trackingLinkUpdateObj);
```

### List All tracking links (uses v1 tracking links list in air bridge)
``` php
use Gado\AirBridgePhpSdk\TrackingLink\TrackingLinkApi;
use Gado\AirBridgePhpSdk\Dto\TrackingLinkListFilter;

$trackingLinkApi = new TrackingLinkApi('your_bearer_token');
$trackingLinkFilterObj = new TrackingLinkListFilter()
    ->from($from)
    ->to($to)
    ->skip(10)
    ->size(100)
    ->keyword('testKeyword')
    ->channelName('testChannel');
    
$result = $trackingLinkApi->listTrackingLinks($trackingLinkFilterObj);
```

### Get a specific tracking link by id
```php
use Gado\AirBridgePhpSdk\TrackingLink\TrackingLinkApi;
use Gado\AirBridgePhpSdk\Dto\TrackingLinkListFilter;

$trackingLinkApi = new TrackingLinkApi('your_bearer_token');
$result = $trackingLinkApi->getSpecificTrackingLink(123);
```

## Features

- Simple, intuitive API for Air Bridge integration
- Built on [Saloon](https://github.com/saloonphp/saloon) HTTP client
- Full PSR-12 compliance
- Type-safe request/response handling

## Change log

Please see [CHANGELOG](CHANGELOG.md) for more information on what has changed recently.

## Testing

``` bash
$ composer test
```

## Contributing

Please see [CONTRIBUTING](CONTRIBUTING.md) for details.

## Security

If you discover any security related issues, please email :author_email instead of using the issue tracker.

## Credits

- [abdelrahman-gado][link-author]
- [All Contributors][link-contributors]

## License

The MIT License (MIT). Please see [License File](LICENSE.md) for more information.

[link-packagist]: https://packagist.org/packages/abdelrahman-gado/air-bridge-php-sdk
[link-code-quality]: https://scrutinizer-ci.com/g/abdelrahman-gado/air-bridge-php-sdk
[link-downloads]: https://packagist.org/packages/abdelrahman-gado/air-bridge-php-sdk
[link-author]: https://github.com/abdelrahman-gado
[link-contributors]: ../../contributors
