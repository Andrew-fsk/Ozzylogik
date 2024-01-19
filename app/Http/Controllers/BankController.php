<?php

namespace App\Http\Controllers;

use App\Models\Bank;
use Illuminate\Support\Facades\Http;

class BankController extends Controller
{
    public function updateBankData(): \Illuminate\Http\JsonResponse
    {
        $banks = Bank::all();
        $api_data = $this->callBankApi($banks->pluck('api_id')->toArray());

        foreach ($banks as $bank) {
            $bank->update([
                'title' => $api_data[$bank->api_id]['title'],
                'slug' => $api_data[$bank->api_id]['slug'],
                'description' => $api_data[$bank->api_id]['attributes']['aboutText'] ?? '',
                'logo' => $api_data[$bank->api_id]['logo'],
                'site' => $api_data[$bank->api_id]['site'],
                'phone' => $api_data[$bank->api_id]['phone'],
                'email' => $api_data[$bank->api_id]['email'],
                'legal_address' => $api_data[$bank->api_id]['legalAddress'],
                'rating' => $api_data[$bank->api_id]['ratingBank']
            ]);
        }

        return response()->json(['message' => 'Bank data updated successfully']);
    }

    private function callBankApi(array $bank_ids): ?array
    {
        try {
            $response = Http::get(config('app_info.bank_endpoint'));
            $api_response = $response->json()['responseData'];

            $banks_data = array_filter($api_response, function ($item) use ($bank_ids) {
                return in_array($item['id'], $bank_ids);
            });

            $data = [];
            foreach ($banks_data as $bank) {
                $data[$bank['id']] = $bank;
            }
            return $data;
        } catch (\Exception $e) {
            return null;
        }
    }
}
