<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BankExchangeRate extends Model
{
    use HasFactory;

    public static array $rate_types = ['cash', 'card'];

    protected $fillable  = [
        'currency_id',
        'bank_id',
        'type',
        'bid',
        'ask',
    ];

    public function currency(): \Illuminate\Database\Eloquent\Relations\HasOne
    {
        return $this->hasOne(Currency::class,'id', 'currency_id');
    }
}
