<?php

declare(strict_types=1);

namespace Gado\AirBridgePhpSdk;

use Gado\AirBridgePhpSdk\Enums\LanguageEnum;
use Gado\AirBridgePhpSdk\Helpers\Common;
use Saloon\Http\Auth\TokenAuthenticator;
use Saloon\Http\Connector;

class AirBridgeConnector extends Connector
{
    public function __construct(
        protected string $token,
        protected LanguageEnum $language = LanguageEnum::ENGLISH,
    ) {
    }

    public function resolveBaseUrl(): string
    {
        return Common::config('baseUrl');
    }

    public function defaultHeaders(): array
    {
        return [
            'Accept-Language' => $this->language->value,
            'Content-Type' => Common::config('contentType'),
        ];
    }

    public function defaultAuth(): TokenAuthenticator
    {
        return new TokenAuthenticator($this->token);
    }
}
