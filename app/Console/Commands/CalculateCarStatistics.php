<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Car;

class CalculateCarStatistics extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'cars:statistics';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Calculate statistics for cars';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $totalCars = Car::count();
        $averagePrice = Car::avg('price');
        $averageMileage = Car::avg('mileage');

        $this->info('Car Statistics:');
        $this->info('Total Cars: ' . $totalCars);
        $this->info('Average Price: $' . number_format($averagePrice, 2));
        $this->info('Average Mileage: ' . number_format($averageMileage, 2) . ' miles');
    }
}
