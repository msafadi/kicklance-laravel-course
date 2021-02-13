<?php

namespace App\Http\Controllers;

use App\Services\CurrencyConverter;
use Illuminate\Http\Request;

class CurrencyController extends Controller
{
    public function convert($from, $to)
    {
        $apiKey = config('services.currency-converter.key');
        $converter = new CurrencyConverter($apiKey);
        $value = $converter->convert($from, $to);

        dd($value);
    }
}
