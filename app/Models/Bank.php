<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Bank extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'slug',
        'description',
        'logo',
        'site',
        'phone',
        'email',
        'legal_address',
        'rating'
    ];

    protected $casts = [
        'logo' => 'array'
    ];

    public function branches(): \Illuminate\Database\Eloquent\Relations\HasMany
    {
        return $this->hasMany(Branch::class, 'bank_id', 'id');
    }

    public function rates(): \Illuminate\Database\Eloquent\Relations\HasMany
    {
        return $this->hasMany(BankExchangeRate::class, 'bank_id', 'id');
    }

    public function getRate(string $type, int $currency_id): Model|\Illuminate\Database\Eloquent\Relations\HasMany|null
    {
        return $this->rates()
            ->where('type', $type)
            ->where('currency_id', $currency_id)
            ->orderByDesc('created_at')
            ->first();
    }

    public function getExchangeRates(): array
    {
        $formattedRates = [];

        foreach (Currency::all() as $currency) {
            $currencyCode = $currency->code;
            $latestCardRate = $this->getRate('card', $currency->id);
            $latestCashRate = $this->getRate('cash', $currency->id);
            $formattedRates[$currencyCode]['currency_id'] = $currency->id;

            if ($latestCardRate) {
                $formattedRates[$currencyCode]['card'] = $this->getFormattedRate($latestCardRate);
            } else {
                $formattedRates[$currencyCode]['card'] = null;
            }

            if ($latestCashRate) {
                $formattedRates[$currencyCode]['cash'] = $this->getFormattedRate($latestCashRate);
            } else {
                $formattedRates[$currencyCode]['cash'] = null;
            }

        }

        return $formattedRates;
    }

    protected function getFormattedRate($rate): array
    {
        return [
            'date' => $rate->created_at,
            'bid' => $rate->bid,
            'ask' => $rate->ask,
        ];
    }

}
