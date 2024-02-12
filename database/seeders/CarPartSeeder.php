<?php

namespace Database\Seeders;

use App\Models\CarPart;
use Illuminate\Database\Seeder;

class CarPartSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        CarPart::factory(50)->create();
    }
}
