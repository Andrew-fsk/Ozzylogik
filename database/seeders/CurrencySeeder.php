<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CurrencySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $currencies = ['USD', 'EUR', 'GBP', 'CHF', 'PLN'];

        foreach ($currencies as $currency) {
            DB::table('currencies')->insert([
                'code' => $currency,
                'title' => $currency
            ]);
        }

    }
}
