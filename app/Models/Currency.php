<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Currency extends Model
{
    use HasFactory;

    public function getNbuRates(): \Illuminate\Database\Eloquent\Relations\HasMany
    {
        return $this->hasMany(NbuExchangeRate::class, 'currency_id', 'id');
    }

    public function getLastNbuRate(): Model|\Illuminate\Database\Eloquent\Relations\HasMany|null
    {
        return $this->getNbuRates()->orderByDesc('created_at')->first();
    }
    public function getMiddleBankRate()
    {
        $banks = Bank::all();
        $middle_rate = [];
        foreach (BankExchangeRate::$rate_types as $key => $rate_type) {
            $middle_rate[$rate_type] = [
                'ask' => [],
                'bid' => [],
            ];
        }
        foreach ($banks as $bank) {
            foreach (BankExchangeRate::$rate_types as $key => $rate_type) {
                $latestRate = $bank->getRate($rate_type, $this->id);
                if ($latestRate) {
                    $middle_rate[$rate_type]['ask'][] = $latestRate->ask;
                    $middle_rate[$rate_type]['bid'][] = $latestRate->bid;
                }
            }

        }

        foreach (BankExchangeRate::$rate_types as $key => $rate_type) {
            if (count($middle_rate[$rate_type]['ask'])) $middle_rate[$rate_type]['ask'] = round(array_sum($middle_rate[$rate_type]['ask']) / count($middle_rate[$rate_type]['ask']), 2);
            if (count($middle_rate[$rate_type]['bid'])) $middle_rate[$rate_type]['bid'] = round(array_sum($middle_rate[$rate_type]['bid']) / count($middle_rate[$rate_type]['bid']), 2);
        }

        return $middle_rate;
    }
}
