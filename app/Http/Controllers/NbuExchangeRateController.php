<?php

namespace App\Http\Controllers;

use App\Models\Currency;
use App\Models\NbuExchangeRate;
use Illuminate\Support\Facades\Http;

class NbuExchangeRateController extends Controller
{
    public function updateNbuExchangeRateData(): void
    {
        $currencies = Currency::all();
        $nbu_rates = $this->callNbuExchangeRateApi();
        foreach ($currencies as $currency) {
            NbuExchangeRate::create([
                'currency_id' => $currency->id,
                'rate' => $nbu_rates[$currency->code],
            ]);
        }
    }

    private function callNbuExchangeRateApi()
    {
        try {
            $response = Http::get(config('app_info.nbu_currencies_endpoint'));
            $response = $response->json();
            return array_column($response, 'rate', 'cc');
        } catch (\Exception $e) {
            return null;
        }
    }
}
