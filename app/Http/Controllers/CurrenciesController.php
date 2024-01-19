<?php

namespace App\Http\Controllers;

use App\Http\Resources\CurrencyResource;
use App\Models\Currency;

class CurrenciesController extends Controller
{
    public function index(): \Illuminate\Http\Resources\Json\AnonymousResourceCollection
    {
        $currencies = Currency::all();
        return CurrencyResource::collection($currencies);
    }
}
