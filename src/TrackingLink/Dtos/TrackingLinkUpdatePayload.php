<?php

declare(strict_types=1);

namespace Gado\AirBridgePhpSdk\TrackingLink\Dtos;

use BadMethodCallException;
use Gado\AirBridgePhpSdk\Enums\IdTypeEnum;

class TrackingLinkUpdatePayload
{
    private IdTypeEnum $idType = IdTypeEnum::ID;
    private ?string $title = null;
    private ?string $imageUrl = null;
    private ?string $description = null;

    public function idType(IdTypeEnum $idType): static
    {
        $this->idType = $idType;
        return $this;
    }

    public function title(string $title): static
    {
        $this->title = $title;
        return $this;
    }

    public function description(string $description): static
    {
        $this->description = $description;
        return $this;
    }

    public function imageUrl(string $imageUrl): static
    {
        $this->imageUrl = $imageUrl;
        return $this;
    }

    public function build(): array
    {
        if (!$this->title || !$this->description || !$this->imageUrl) {
            throw new BadMethodCallException('Title, Description and ImageUrl are required to build TrackingLinkUpdatePayload.');
        }

        return [
            'idType' => $this->idType->value,
            'title' => $this->title,
            'description' => $this->description,
            'imageUrl' => $this->imageUrl,
        ];
    }
}
