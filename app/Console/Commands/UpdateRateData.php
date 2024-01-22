<?php

namespace App\Console\Commands;

use App\Http\Controllers\BankExchangeRateController;
use App\Http\Controllers\NbuExchangeRateController;
use Illuminate\Console\Command;

class UpdateRateData extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:update-rate-data';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Update data about rates from external API';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        app(NbuExchangeRateController::class)->updateNbuExchangeRateData();
        app(BankExchangeRateController::class)->updateBankExchangeRateData();
        $this->info('Rate data updated successfully.');

    }
}
