<?php

namespace App\Tests;

use App\Handler\CurrencyExchangeRate;
use App\Provider\CurrencyRateDataProviderInterface;
use PHPUnit\Framework\TestCase;

class CurrencyConverterTest extends TestCase
{
    public function testConvertToEur(): void
    {
        $currencyRateDataProviderMock = $this->createMock(CurrencyRateDataProviderInterface::class);
        $currencyRateDataProviderMock
            ->method('getRates')
            ->willReturn(
                [
                    'USD' => 1.10,
                    'GBP' => 0.85,
                ]
            );

        $currencyExchangeRate = new CurrencyExchangeRate($currencyRateDataProviderMock);
        $delta = 0.00001;

        // Test conversion from EUR to EUR (no conversion)
        $convertedAmount = $currencyExchangeRate->convertToEur('EUR', 100);
        $this->assertEqualsWithDelta(100, $convertedAmount, $delta);

        // Test conversion from USD to EUR
        $convertedAmount = $currencyExchangeRate->convertToEur('USD', 110);
        $this->assertEqualsWithDelta(100, $convertedAmount, $delta);

        // Test conversion from GBP to EUR
        $convertedAmount = $currencyExchangeRate->convertToEur('GBP', 85);
        $this->assertEqualsWithDelta(100, $convertedAmount, $delta);
    }

    public function testConvertToEurWithInvalidCurrency(): void
    {
        $currencyRateDataProviderMock = $this->createMock(CurrencyRateDataProviderInterface::class);
        $currencyRateDataProviderMock
            ->method('getRates')
            ->willReturn([]);

        $currencyExchangeRate = new CurrencyExchangeRate($currencyRateDataProviderMock);
        $convertedAmount = $currencyExchangeRate->convertToEur('INVALID', 100);

        $this->assertEquals(100, $convertedAmount);
    }
}