<?php

namespace App\Handler;

use App\Provider\BinDataProviderInterface;

class BinLookup implements BinLookupInterface
{
    protected BinDataProviderInterface $binDataProvider;

    public function __construct(BinDataProviderInterface $binDataProvider)
    {
        $this->binDataProvider = $binDataProvider;
    }

    /**
     * @inheritDoc
     */
    public function getCountryCode(string $bin): ?string
    {
        $binData = $this->binDataProvider->getBinDataForBin($bin);

        return $binData['country']['alpha2'] ?? null;
    }
}