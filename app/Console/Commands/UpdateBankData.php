<?php

namespace App\Console\Commands;

use App\Http\Controllers\BankController;
use App\Http\Controllers\BankExchangeRateController;
use App\Http\Controllers\BranchController;
use App\Http\Controllers\NbuExchangeRateController;
use Illuminate\Console\Command;

class UpdateBankData extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:update-bank-data';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Update data about banks from external API';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        app(BankController::class)->updateBankData();
        app(BranchController::class)->updateBranchData();
        app(NbuExchangeRateController::class)->updateNbuExchangeRateData();
        app(BankExchangeRateController::class)->updateBankExchangeRateData();

        $this->info('Bank data updated successfully.');
    }
}
