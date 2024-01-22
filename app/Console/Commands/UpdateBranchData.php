<?php

namespace App\Console\Commands;

use App\Http\Controllers\BranchController;
use Illuminate\Console\Command;

class UpdateBranchData extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:update-branch-data';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Update data about bank branches from external API';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        app(BranchController::class)->updateBranchData();
        $this->info('Bank branches data updated successfully.');

    }
}
