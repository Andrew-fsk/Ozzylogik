<?php

namespace App\Http\Resources;

use App\Models\Currency;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class BankExchangeRateResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'cash' => $this->formatRates('cash'),
            'card' => $this->formatRates('card'),
        ];
    }

}
