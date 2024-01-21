<?php

namespace App\Http\Controllers;

use App\Models\Bank;
use App\Models\BankExchangeRate;
use App\Models\Currency;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class BankExchangeRateController extends Controller
{
    public function updateBankExchangeRateData()
    {
        $currencies = Currency::all();
        $bank_slugs_ids = Bank::all()->pluck( 'id', 'slug')->toArray();

        foreach ($currencies as $currency) {
            $currency_rates = $this->callBankExchangeRateApi($currency, $bank_slugs_ids);
            foreach ($currency_rates as $bank_id => $bank_rates) {
                foreach ($bank_rates as $bank_rate) {
                    BankExchangeRate::create($bank_rate);
                }
            }
        }
    }

    private function callBankExchangeRateApi(Currency $currency, array $bank_slugs_ids): ?array
    {
        try {
            $data = [];
            $page = 1;
            $response = Http::get(config('app_info.banks_currencies_endpoint') . $currency->code)->json();

            while (count($data) != count($bank_slugs_ids) && isset($response['meta']['next'])) {
                foreach ($response['data'] as $bank_rate) {
                    if (isset($bank_slugs_ids[$bank_rate['slug']]) || isset($bank_slugs_ids[str_replace('-', '', $bank_rate['slug'])])) {
                        foreach (BankExchangeRate::$rate_types as $key => $rate_type) {
                            if (!is_null($bank_rate[$rate_type])) {
                                $data[$bank_slugs_ids[$bank_rate['slug']]][] = [
                                    'currency_id' => $currency->id,
                                    'bank_id' => $bank_slugs_ids[$bank_rate['slug']],
                                    'type' => $rate_type,
                                    'bid' => floatval($bank_rate[$rate_type]['bid']),
                                    'ask' => floatval($bank_rate[$rate_type]['ask']),
                                ];
                            }
                        }
                    }
                }

                $page += 1;
                $response = Http::get(config('app_info.banks_currencies_endpoint') . $currency->code, ['page' => $page])->json();
            }
            return $data;
        } catch (\Exception $e) {
            return null;
        }
    }

}
