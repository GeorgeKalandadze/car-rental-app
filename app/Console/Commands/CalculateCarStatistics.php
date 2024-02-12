<?php

namespace App\Console\Commands;

use App\Models\Brand;
use App\Models\Car;
use App\Models\CarModel;
use Illuminate\Console\Command;

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
        $mostPopularBrand = Car::select('brand_id')
            ->groupBy('brand_id')
            ->orderByRaw('COUNT(*) DESC')
            ->pluck('brand_id')
            ->first();
        $mostPopularBrandName = $mostPopularBrand ? Brand::find($mostPopularBrand)->name : 'Unknown';

        $mostPopularModelId = Car::select('model_id')
            ->where('brand_id', $mostPopularBrand)
            ->groupBy('model_id')
            ->orderByRaw('COUNT(*) DESC')
            ->pluck('model_id')
            ->first();

        $mostPopularModel = $mostPopularModelId ? CarModel::find($mostPopularModelId)->name : 'Unknown';

        $mostExpensiveCars = Car::orderBy('price', 'desc')->take(3)->get();

        $this->info('Car Statistics:');
        $this->info('Total Cars: '.$totalCars);
        $this->info('Average Price: $'.number_format($averagePrice, 2));
        $this->info('Average Mileage: '.number_format($averageMileage, 2).' miles');
        $this->info('Most Popular Brand: '.$mostPopularBrandName);
        $this->info('Most Popular Model of '.$mostPopularBrandName.': '.$mostPopularModel);

        $this->info('Most Expensive Cars:');
        foreach ($mostExpensiveCars as $car) {
            $this->info(' Model: '.$car->model.', Price: $'.number_format($car->price, 2));
        }
    }
}
