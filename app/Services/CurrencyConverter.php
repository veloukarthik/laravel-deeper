<?php
namespace App\Services;
use GuzzleHttp\Client as HttpClient;
use CurrencyApi\CurrencyApi\CurrencyApiClient;
class CurrencyConverter{
    protected $rates;

    public function __construct()
    {
        // Fetch and store conversion rates
        $this->rates = $this->fetchRates();
    }

    public function convert($amount, $from, $to)
    {
        $currencyApi = new CurrencyApiClient(env('CURRENCY_API_KEY', 'cur_live_dTuY6SEuBJYHV4lKKa36Vrx3Cqb3hz0mKq2aKX4O'));
        $results = $currencyApi->latest([
            'base_currency' => $from,
            'currencies' => $to,
            'amount' => $amount,
        ]);
        $amount = number_format($results['data'][$to]["value"]*$amount,2);
        return $amount;
        // Conversion logic using $this->rates
    }
    protected function fetchRates()
    {
        // Fetch exchange rates from an API or database
        return 'fetched';
    }
}