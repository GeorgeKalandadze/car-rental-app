<?php

namespace Database\Seeders;

use App\Models\CarPartCategory;
use Illuminate\Database\Seeder;

class CarPartCategoriesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $categories = [
            [
                'name' => 'Engine Parts',
                'children' => [
                    ['name' => 'Engine Block'],
                    ['name' => 'Pistons'],
                ],
            ],
            [
                'name' => 'Brake System',
                'children' => [
                    ['name' => 'Brake Pads'],
                    ['name' => 'Brake Calipers'],
                ],
            ],
        ];

        foreach ($categories as $categoryData) {
            $category = CarPartCategory::create(['name' => $categoryData['name']]);
            if (isset($categoryData['children'])) {
                foreach ($categoryData['children'] as $childData) {
                    $childCategory = CarPartCategory::create(['name' => $childData['name']]);
                    $childCategory->parent_id = $category->id;
                    $childCategory->save();
                }
            }
        }
    }
}
