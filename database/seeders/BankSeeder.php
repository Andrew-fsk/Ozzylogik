<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class BankSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        foreach (config('app_info.api_bank_ids') as $bank_api_id) {
            DB::table('banks')->insert([
                'api_id' => $bank_api_id,
                'created_at' => now(),
            ]);
        }
    }
}
