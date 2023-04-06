<?php

namespace App\Tests;

use App\Calculator\TransactionFeeCalculator;
use App\Checker\Country\CountryCheckerInterface;
use App\Handler\BinLookupInterface;
use App\Handler\CurrencyExchangeInterface;
use PHPUnit\Framework\TestCase;

class FeeCalculatorTest extends TestCase
{
    public function testCalculateFee(): void
    {
        $binLookupMock = $this->createMock(BinLookupInterface::class);
        $binLookupMock->method('getCountryCode')->willReturn('US');

        $currencyConverterMock = $this->createMock(CurrencyExchangeInterface::class);
        $currencyConverterMock->method('convertToEur')->willReturn(100.0);

        $euCountryCheckerMock = $this->createMock(CountryCheckerInterface::class);
        $euCountryCheckerMock->method('checkCountryCode')->willReturn(false);

        $feeCalculator = new TransactionFeeCalculator($binLookupMock, $currencyConverterMock, $euCountryCheckerMock);
        $this->assertEquals(2, $feeCalculator->calculateFee('123456', 'USD', 110));
    }

    public function testCalculateFeeForEUCountry(): void
    {
        $binLookupMock = $this->createMock(BinLookupInterface::class);
        $binLookupMock->method('getCountryCode')->willReturn('FR');

        $currencyConverterMock = $this->createMock(CurrencyExchangeInterface::class);
        $currencyConverterMock->method('convertToEur')->willReturn(100.0);

        $euCountryCheckerMock = $this->createMock(CountryCheckerInterface::class);
        $euCountryCheckerMock->method('checkCountryCode')->willReturn(true);

        $feeCalculator = new TransactionFeeCalculator($binLookupMock, $currencyConverterMock, $euCountryCheckerMock);
        $this->assertEquals(1, $feeCalculator->calculateFee('123456', 'EUR', 100));
    }
}