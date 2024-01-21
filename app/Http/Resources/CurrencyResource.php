<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class CurrencyResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'code' => $this->code,
            'title' => $this->title,
            'nbu_rate' => [
                'rate' => $this->getLastNbuRate()->rate,
                'created_at' => $this->getLastNbuRate()->created_at,
            ],
            'middle_bank_rate' => $this->getMiddleBankRate()
        ];
    }
}
