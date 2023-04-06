<?php

namespace App\Tests;

use App\Checker\Country\CountryCheckerInterface;
use App\Checker\Country\EuCountryChecker;
use PHPUnit\Framework\MockObject\MockObject;
use PHPUnit\Framework\TestCase;

class EuCountryCheckerTest extends TestCase
{
    private CountryCheckerInterface|MockObject  $euCountryChecker;

    protected function setUp(): void
    {
        $this->euCountryChecker = new EuCountryChecker();
    }

    public function testCheckCountryCode(): void
    {
        // Test EU country code
        $isEu = $this->euCountryChecker->checkCountryCode('DE');
        $this->assertTrue($isEu);

        // Test non-EU country code
        $isEu = $this->euCountryChecker->checkCountryCode('US');
        $this->assertFalse($isEu);

        // Test null value
        $isEu = $this->euCountryChecker->checkCountryCode(null);
        $this->assertFalse($isEu);

        // Test invalid country code
        $isEu = $this->euCountryChecker->checkCountryCode('INVALID');
        $this->assertFalse($isEu);
    }
}