<?php

declare(strict_types=1);

namespace Gado\AirBridgePhpSdk\TrackingLink\Dtos;

use BadMethodCallException;
use DateTimeImmutable;
use Gado\AirBridgePhpSdk\Enums\SortKeyEnum;
use Gado\AirBridgePhpSdk\Enums\SortTypeEnum;
use InvalidArgumentException;

class TrackingLinkListFilter
{
    private ?DateTimeImmutable $from = null;
    private ?DateTimeImmutable $to = null;
    private ?int $skip = null;
    private ?int $size = null;
    private ?string $keyword = null;
    private ?string $channelName = null;
    private ?SortKeyEnum $sortKey = null;
    private ?SortTypeEnum $sortType = null;

    public function from(DateTimeImmutable $from): static
    {
        $this->from = $from;
        return $this;
    }

    public function to(DateTimeImmutable $to): static
    {
        $this->to = $to;
        return $this;
    }

    public function skip(int $skip): static
    {
        if ($skip < 0) {
            $skip = 0;
        }

        $this->skip = $skip;
        return $this;
    }

    public function size(int $size): static
    {
        if ($size < 1) {
            $size = 1;
        }

        if ($size >= 500) {
            throw new InvalidArgumentException('Size must be less than 500.');
        }

        $this->size = $size;
        return $this;
    }

    public function keyword(string $keyword): static
    {
        $this->keyword = $keyword;
        return $this;
    }

    public function channelName(string $channelName): static
    {
        $this->channelName = $channelName;
        return $this;
    }

    public function sortKey(SortKeyEnum $sortKey): static
    {
        $this->sortKey = $sortKey;
        return $this;
    }

    public function sortType(SortTypeEnum $sortType): static
    {
        $this->sortType = $sortType;
        return $this;
    }

    public function getQueryParams(): array
    {
        if (!$this->from || !$this->to) {
            throw new BadMethodCallException('Both "from" and "to" dates must be set.');
        }
        
        if ($this->from > $this->to) {
            throw new BadMethodCallException('From date must be earlier than to date.');
        }

        return array_filter([
            'from' => $this->from->format('Y-m-d'),
            'to' => $this->to->format('Y-m-d'),
            'skip' => $this->skip,
            'size' => $this->size,
            'keyword' => $this->keyword,
            'channelName' => $this->channelName,
            'sortKey' => $this->sortKey?->value,
            'sortType' => $this->sortType?->value,
        ], fn($value) => $value !== null);
    }
}
