<?php

declare(strict_types=1);

namespace Gado\AirBridgePhpSdk\Tests\Unit\Dtos;

use BadMethodCallException;
use DateTimeImmutable;
use Gado\AirBridgePhpSdk\Enums\SortKeyEnum;
use Gado\AirBridgePhpSdk\Enums\SortTypeEnum;
use Gado\AirBridgePhpSdk\TrackingLink\Dtos\TrackingLinkListFilter;
use InvalidArgumentException;
use PHPUnit\Framework\Attributes\CoversClass;
use PHPUnit\Framework\Attributes\Test;
use PHPUnit\Framework\TestCase;

#[CoversClass(TrackingLinkListFilter::class)]
final class TrackingLinkListFilterTest extends TestCase
{
    private TrackingLinkListFilter $filter;

    protected function setUp(): void
    {
        $this->filter = new TrackingLinkListFilter();
    }

    #[Test()]
    public function testFluentInterface(): void
    {
        $from = new DateTimeImmutable();
        $to = new DateTimeImmutable();

        $result = $this->filter
            ->from($from)
            ->to($to)
            ->skip(10)
            ->size(100)
            ->keyword('testKeyword')
            ->channelName('testChannel');

        $this->assertSame($result, $this->filter);
    }

    #[Test()]
    public function testFromMethodTakeOnlyDateTime(): void
    {
        $this->expectException(\TypeError::class);
        $this->filter->from('2024-01-01');

        $this->expectException(\TypeError::class);
        $this->filter->from(123);

        $this->expectException(\TypeError::class);
        $this->filter->from(false);

        $this->expectException(\TypeError::class);
        $this->filter->from(null);

        $this->expectException(\TypeError::class);
        $this->filter->from(new stdClass);

        $this->expectException(\TypeError::class);
        $this->filter->from(function () {});

        $result = $this->filter->from(new DateTimeImmutable());
        $this->assertSame($result, $this->filter);
    }

    #[Test()]
    public function testToMethodTakeOnlyDateTime(): void
    {
        $this->expectException(\TypeError::class);
        $this->filter->to('2024-01-01');

        $this->expectException(\TypeError::class);
        $this->filter->to(123);

        $this->expectException(\TypeError::class);
        $this->filter->to(false);

        $this->expectException(\TypeError::class);
        $this->filter->to(null);

        $this->expectException(\TypeError::class);
        $this->filter->to(new stdClass);

        $this->expectException(\TypeError::class);
        $this->filter->to(function () {});

        $result = $this->filter->to(new DateTimeImmutable());
        $this->assertSame($result, $this->filter);
    }

    #[Test()]
    public function testSkipMethodTakeOnlyInteger(): void
    {
        $this->expectException(\TypeError::class);
        $this->filter->skip('10');

        $this->expectException(\TypeError::class);
        $this->filter->skip(10.5);

        $this->expectException(\TypeError::class);
        $this->filter->skip(false);

        $this->expectException(\TypeError::class);
        $this->filter->skip(null);

        $this->expectException(\TypeError::class);
        $this->filter->skip(new stdClass);

        $this->expectException(\TypeError::class);
        $this->filter->skip(function () {});

        $result = $this->filter->skip(10);
        $this->assertSame($this->filter, $result);
    }

    #[Test()]
    public function testSizeMethodTakeOnlyIntegerLessThan500(): void
    {
        $this->expectException(\TypeError::class);
        $this->filter->size('100');

        $this->expectException(\TypeError::class);
        $this->filter->size(100.5);

        $this->expectException(\TypeError::class);
        $this->filter->size(false);

        $this->expectException(\TypeError::class);
        $this->filter->size(null);

        $this->expectException(\TypeError::class);
        $this->filter->size(new stdClass);

        $this->expectException(InvalidArgumentException::class);
        $this->filter->size(500);

        $result = $this->filter->size(100);
        $this->assertSame($this->filter, $result);
    }

    #[Test()]
    public function testKeywordMethodTakeOnlyString(): void
    {
        $this->expectException(\TypeError::class);
        $this->filter->keyword(123);

        $this->expectException(\TypeError::class);
        $this->filter->keyword(10.5);

        $this->expectException(\TypeError::class);
        $this->filter->keyword(false);

        $this->expectException(\TypeError::class);
        $this->filter->keyword(null);

        $this->expectException(\TypeError::class);
        $this->filter->keyword(new stdClass);

        $result = $this->filter->keyword('testKeyword');
        $this->assertSame($result, $this->filter);
    }


    #[Test()]
    public function testChannelNameMethodTakeOnlyString(): void
    {
        $this->expectException(\TypeError::class);
        $this->filter->channelName(123);

        $this->expectException(\TypeError::class);
        $this->filter->channelName(10.5);

        $this->expectException(\TypeError::class);
        $this->filter->channelName(false);

        $this->expectException(\TypeError::class);
        $this->filter->channelName(null);

        $this->expectException(\TypeError::class);
        $this->filter->channelName(new stdClass);

        $result = $this->filter->channelName('testKeyword');
        $this->assertSame($result, $this->filter);
    }


    #[Test()]
    public function testSortKeyMethodTakeOnlySortKeyEnum(): void
    {
        $this->expectException(\TypeError::class);
        $this->filter->sortKey(123);

        $this->expectException(\TypeError::class);
        $this->filter->sortKey(10.5);

        $this->expectException(\TypeError::class);
        $this->filter->sortKey(false);

        $this->expectException(\TypeError::class);
        $this->filter->sortKey(null);

        $this->expectException(\TypeError::class);
        $this->filter->sortKey(new stdClass);

        $result = $this->filter->sortKey(SortKeyEnum::CREATED_AT);
        $this->assertSame($result, $this->filter);
    }

    #[Test()]
    public function testSortTypeMethodTakeOnlySortTypeEnum(): void
    {
        $this->expectException(\TypeError::class);
        $this->filter->sortType(123);

        $this->expectException(\TypeError::class);
        $this->filter->sortType(10.5);

        $this->expectException(\TypeError::class);
        $this->filter->sortType(false);

        $this->expectException(\TypeError::class);
        $this->filter->sortType(null);

        $this->expectException(\TypeError::class);
        $this->filter->sortType(new stdClass);

        $result = $this->filter->sortType(SortTypeEnum::ASC);
        $this->assertSame($result, $this->filter);

        $result = $this->filter->sortType(SortTypeEnum::DESC);
        $this->assertSame($result, $this->filter);
    }

    #[Test()]
    public function testGetQueryParamsMethodReturnArray(): void
    {
        $paramsArray = $this->filter
            ->from(new DateTimeImmutable('2024-01-01'))
            ->to(new DateTimeImmutable('2024-01-31'))
            ->skip(10)
            ->size(50)
            ->keyword('testKeyword')
            ->channelName('testChannel')
            ->sortKey(SortKeyEnum::CREATED_AT)
            ->sortType(SortTypeEnum::ASC)
            ->getQueryParams();

        $this->assertIsArray($paramsArray);
        $this->assertSame(
            [
                'from' => '2024-01-01',
                'to' => '2024-01-31',
                'skip' => 10,
                'size' => 50,
                'keyword' => 'testKeyword',
                'channelName' => 'testChannel',
                'sortKey' => 'createdAt',
                'sortType' => 'ASC',
            ],
            $this->filter->getQueryParams()
        );
    }
    

    #[Test()]
    public function testGetQueryParamsMethodThrowsBadMethodCallExceptionWhenNoFormOrNoToSet(): void
    {
        $this->expectException(BadMethodCallException::class);
        $this->filter
            ->to(new DateTimeImmutable('2024-01-31'))
            ->getQueryParams();

        $this->expectException(BadMethodCallException::class);
        $this->filter
            ->from(new DateTimeImmutable('2024-01-01'))
            ->getQueryParams();
        
        $this->expectException(BadMethodCallException::class);
        $this->filter
            ->getQueryParams();
    }
    
    #[Test()]
    public function testGetQueryParamsWithNullableData(): void
    {
        $paramsArray = $this->filter
            ->from(new DateTimeImmutable('2024-01-01'))
            ->to(new DateTimeImmutable('2024-01-31'))
            ->getQueryParams();

        $this->assertIsArray($paramsArray);
        $this->assertSame(
            [
                'from' => '2024-01-01',
                'to' => '2024-01-31',
            ],
            $this->filter->getQueryParams()
        );
    }
    
    #[Test()]
    public function testGetQueryParamsMethodThrowsBadMethodCallExceptionWhenFromIsLaterThanTo(): void
    {
        $this->expectException(BadMethodCallException::class);
        $this->filter
            ->from(new DateTimeImmutable('2024-02-01'))
            ->to(new DateTimeImmutable('2024-01-31'))
            ->getQueryParams();
    }
}
