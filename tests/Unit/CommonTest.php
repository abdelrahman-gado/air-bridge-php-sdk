<?php

declare(strict_types=1);

namespace Gado\AirBridgePhpSdk\Tests\Unit;

use Gado\AirBridgePhpSdk\Helpers\Common;
use PHPUnit\Framework\Attributes\Test;
use PHPUnit\Framework\TestCase;
use stdClass;
use TypeError;

final class CommonTest extends TestCase
{
    #[Test]
    public function testConfigTakesNullableString(): void
    {
        $this->assertSame(Common::config('baseUrl'), 'https://api.airbridge.io');
        $this->assertSame(Common::config(null), null);
    }
    
    #[Test]
    public function testConfigThrowsExceptionWhenTakesAnythingOtherThanNullableString(): void
    {
        $this->expectException(TypeError::class);
        $this->assertSame(Common::config(1), 1); 

        $this->expectException(TypeError::class);
        $this->assertSame(Common::config([]), []); 

        $this->expectException(TypeError::class);
        $this->assertSame(Common::config(new stdClass()), null); 

        $this->expectException(TypeError::class);
        $this->assertSame(Common::config(false), null); 

        $this->expectException(TypeError::class);
        $this->assertSame(Common::config(1.1), null); 
        
        $this->expectException(TypeError::class);
        $this->assertSame(Common::config(function () {}), null); 
    }    
    

    #[Test]
    public function testConfigReturnNullWhenPassingNullAsParameter(): void
    {
        $this->assertNull(Common::config());
    }
    
    #[Test]
    public function testConfigReturnSuccessfulWhenFirstLevelMatch(): void
    {
        $this->assertSame(Common::config('baseUrl'), 'https://api.airbridge.io');
    }

    #[Test]
    public function testConfigReturnSuccessfulWhenSecondLevelMatch(): void
    {
        $this->assertSame(Common::config('trackingLinks.basePath'), '/v1/tracking-links'); 
    }
}
