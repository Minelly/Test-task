<?php

use App\Calculator\TransactionFeeCalculator;
use App\Checker\Country\EuCountryChecker;
use App\Handler\BinLookup;
use App\Handler\CurrencyExchangeRate;
use App\Provider\BinDataProvider;
use App\Provider\ExchangeRateDataProvider;

require_once __DIR__ . '/vendor/autoload.php';

$binDataProvider = new BinDataProvider();
$binLookup = new BinLookup($binDataProvider);
$exchangeRateDataProvider = new ExchangeRateDataProvider();
$currencyConverter = new CurrencyExchangeRate($exchangeRateDataProvider);
$currencyChecker = new EuCountryChecker();
$calculator = new TransactionFeeCalculator($binLookup, $currencyConverter, $currencyChecker);

$inputFile = 'input.txt';
$inputData = file_get_contents($inputFile);
$transactions = explode("\n", $inputData);

foreach ($transactions as $transaction) {
    if (empty($transaction)) {
        continue;
    }

    $transactionData = json_decode($transaction, true);
    $fee = $calculator->calculateFee(
        $transactionData['bin'],
        $transactionData['currency'],
        (float)  $transactionData['amount'],
    );

    echo $fee . PHP_EOL;
}