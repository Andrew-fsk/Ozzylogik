<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;

class BankSingleResource extends BankResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        $resourse = parent::toArray($request);
        $resourse['branches'] = BranchResource::collection($this->branches);
        return $resourse;
    }
}
