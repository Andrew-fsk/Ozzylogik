<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DatabaseSeeder extends Seeder
{
    protected array $seeders = [
        CurrencySeeder::class,
        BankSeeder::class,
    ];
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call($this->seeders);
    }
}
