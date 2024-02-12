<?php

namespace Database\Seeders;

use App\Models\Brand;
use Illuminate\Database\Seeder;

class BrandSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $brands = [
            'Toyota' => ['Japan' => ['Corolla', 'Camry', 'Prius', 'RAV4', 'Highlander']],
            'Ford' => ['United States' => ['Mustang', 'F-150', 'Explorer', 'Focus', 'Escape']],
            'Volkswagen' => ['Germany' => ['Golf', 'Passat', 'Jetta', 'Tiguan', 'Atlas']],
            'Mercedes' => ['Germany' => ['C-Class', 'E-Class', 'GLC', 'S-Class', 'G-Class']],
            'BMW' => ['Germany' => ['3 Series', '5 Series', 'X5', '7 Series', 'X3']],
            'Audi' => ['Germany' => ['A3', 'A4', 'Q5', 'Q7', 'A6']],
            'Honda' => ['Japan' => ['Civic', 'Accord', 'CR-V', 'Pilot', 'Odyssey']],
            'Chevrolet' => ['United States' => ['Silverado', 'Malibu', 'Equinox', 'Tahoe', 'Traverse']],
            'Hyundai' => ['South Korea' => ['Elantra', 'Sonata', 'Santa Fe', 'Tucson', 'Kona']],
            'Kia' => ['South Korea' => ['Optima', 'Sorento', 'Sportage', 'Forte', 'Telluride']],
            'Nissan' => ['Japan' => ['Altima', 'Sentra', 'Rogue', 'Pathfinder', 'Titan']],
            'Subaru' => ['Japan' => ['Impreza', 'Outback', 'Forester', 'Crosstrek', 'Ascent']],
            'Lexus' => ['Japan' => ['IS', 'RX', 'NX', 'ES', 'GX']],
            'Jeep' => ['United States' => ['Wrangler', 'Grand Cherokee', 'Cherokee', 'Renegade', 'Compass']],
            'Tesla' => ['United States' => ['Model 3', 'Model S', 'Model X', 'Model Y', 'Cybertruck']],
            'Mazda' => ['Japan' => ['Mazda3', 'Mazda6', 'CX-5', 'CX-9', 'MX-5 Miata']],
            'Volvo' => ['Sweden' => ['S60', 'XC60', 'XC90', 'S90', 'V60']],
            'Porsche' => ['Germany' => ['911', 'Cayenne', 'Panamera', 'Macan', 'Taycan']],
            'Land Rover' => ['United Kingdom' => ['Range Rover', 'Discovery', 'Defender', 'Range Rover Sport', 'Range Rover Evoque']],
        ];

        foreach ($brands as $brandName => $countries) {
            foreach ($countries as $country => $models) {
                $brand = Brand::create(['name' => $brandName, 'country' => $country]);

                foreach ($models as $modelName) {
                    $brand->carModels()->create(['name' => $modelName]);
                }
            }
        }
    }
}
