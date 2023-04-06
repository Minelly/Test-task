<?php

namespace App\Tests;

use App\Exception\CurrencyRateNotFoundException;
use App\Handler\CurrencyExchangeRate;
use App\Provider\CurrencyRateDataProviderInterface;
use PHPUnit\Framework\TestCase;

class CurrencyExchangeRateTest extends TestCase
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

        $this->expectException(CurrencyRateNotFoundException::class);
        $currencyExchangeRate->convertToEur('USD', 100);
    }

    public function testConvertToEurThrowsExceptionWhenRateNotFound(): void
    {
        $currency = 'XYZ';
        $amount = 100;

        $currencyRateDataProviderMock = $this->createMock(CurrencyRateDataProviderInterface::class);
        $currencyRateDataProviderMock->method('getRates')->willReturn(
            [
                'USD' => 1.2,
                'GBP' => 0.85,
            ]
        );

        $currencyExchangeRate = new CurrencyExchangeRate($currencyRateDataProviderMock);

        $this->expectException(CurrencyRateNotFoundException::class);
        $this->expectExceptionMessage("Currency rate not found for: {$currency}");

        $currencyExchangeRate->convertToEur($currency, $amount);
    }
}