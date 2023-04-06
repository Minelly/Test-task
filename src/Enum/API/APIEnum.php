<?php

namespace App\Enum\API;

enum APIEnum: string
{
    case EXCHANGE_REST_API = 'https://api.exchangeratesapi.io/latest';
    case BIN_LIST = 'https://lookup.binlist.net/';
}