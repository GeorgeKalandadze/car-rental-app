<?php

namespace App\Console\Commands;

use App\Models\Car;
use Carbon\Carbon;
use Illuminate\Console\Command;

class DeleteOldCars extends Command
{
    protected $signature = 'car:delete-old';

    protected $description = 'Delete cars older than 30 years';

    public function handle()
    {
        $thresholdYear = Carbon::now()->subYears(30)->year;

        Car::where('year', '<', $thresholdYear)->delete();

        $this->info('Old cars deleted successfully!');
    }
}
