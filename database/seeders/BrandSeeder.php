<?php

namespace Database\Seeders;

use App\Models\Brand;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class BrandSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $brands = [
            ['name' => 'Toyota', 'country' => 'Japan'],
            ['name' => 'Ford', 'country' => 'United States'],
            ['name' => 'Volkswagen', 'country' => 'Germany'],
            ['name' => 'Mercedes', 'country' => 'Germany'],
            ['name' => 'BMW', 'country' => 'Germany'],
            ['name' => 'Audi', 'country' => 'Germany'],
        ];

        foreach ($brands as $brand) {
            Brand::create($brand);
        }
    }
}
