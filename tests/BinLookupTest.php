<?php

namespace App\Tests;

use App\Handler\BinLookup;
use App\Provider\BinDataProviderInterface;
use PHPUnit\Framework\TestCase;

class BinLookupTest extends TestCase
{
    public function testGetCountryCodeUs(): void
    {
        $binDataProviderMock = $this->createMock(BinDataProviderInterface::class);
        $binDataProviderMock
            ->method('getBinDataForBin')
            ->willReturn(
                [
                    'country' => [
                        'alpha2' => 'US',
                    ],
                ]
            );

        $binLookup = new BinLookup($binDataProviderMock);
        $countryCode = $binLookup->getCountryCode('123456');
        $this->assertEquals('US', $countryCode);
    }

    public function testGetCountryCodeDe(): void
    {
        $binDataProviderMock = $this->createMock(BinDataProviderInterface::class);
        $binDataProviderMock
            ->method('getBinDataForBin')
            ->willReturn(
                [
                    'country' => [
                        'alpha2' => 'DE',
                    ],
                ]
            );

        $binLookup = new BinLookup($binDataProviderMock);
        $countryCode = $binLookup->getCountryCode('654321');
        $this->assertEquals('DE', $countryCode);
    }

    public function testGetCountryCodeWithMissingCountry(): void
    {
        $binDataProviderMock = $this->createMock(BinDataProviderInterface::class);
        $binDataProviderMock
            ->method('getBinDataForBin')
            ->willReturn([]);

        $binLookup = new BinLookup($binDataProviderMock);

        $countryCode = $binLookup->getCountryCode('999999');

        $this->assertNull($countryCode);
    }
}