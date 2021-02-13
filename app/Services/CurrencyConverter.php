<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;

class CurrencyConverter
{
    protected $apiKey;

    protected $baseUrl = 'https://free.currconv.com/api/v7';

    public function __construct($apiKey)
    {
        $this->apiKey = $apiKey;
    }

    public function convert($from, $to, $compact = true)
    {
        $key = strtoupper($from) . '_' . strtoupper($to);
        $params = [
            'apiKey' => $this->apiKey,
            'q' => $key,
        ];
        if ($compact) {
            $params['compact'] = 'y';
        }
        $response = Http::baseUrl($this->baseUrl)
            ->post('convert', $params);
        
        $rate = $response->json();
        return $rate[$key]['val'];
    }
}