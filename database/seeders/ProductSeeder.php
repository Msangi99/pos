<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Database\Seeder;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $tenantId = 'DEMO-001';

        $categories = [
            ['name' => 'Beers', 'icon' => '🍺'],
            ['name' => 'Cocktails', 'icon' => '🍸'],
            ['name' => 'Wines', 'icon' => '🍷'],
            ['name' => 'Spirits', 'icon' => '🥃'],
            ['name' => 'Food', 'icon' => '🍔'],
        ];

        foreach ($categories as $catData) {
            $category = Category::create([
                'name' => $catData['name'],
                'icon' => $catData['icon'],
                'tenant_id' => $tenantId
            ]);

            // Add dummy products based on category
            $products = match($catData['name']) {
                'Beers' => [
                    ['name' => 'Serengeti Premium', 'price' => 3500],
                    ['name' => 'Kilimanjaro Lager', 'price' => 3000],
                    ['name' => 'Safari Lager', 'price' => 3000],
                    ['name' => 'Heineken', 'price' => 5000],
                    ['name' => 'Castle Lite', 'price' => 4500],
                ],
                'Cocktails' => [
                    ['name' => 'Mojito', 'price' => 12000],
                    ['name' => 'Long Island Iced Tea', 'price' => 15000],
                    ['name' => 'Dawa', 'price' => 8000],
                    ['name' => 'Whisky Sour', 'price' => 10000],
                ],
                'Wines' => [
                    ['name' => 'Red Wine (Glass)', 'price' => 7000],
                    ['name' => 'White Wine (Glass)', 'price' => 7000],
                    ['name' => 'Robertson Sweet Red', 'price' => 35000],
                    ['name' => 'Nederburg Cabernet', 'price' => 55000],
                ],
                'Spirits' => [
                    ['name' => 'Jack Daniels (Shot)', 'price' => 6000],
                    ['name' => 'Hennessey VS (Shot)', 'price' => 12000],
                    ['name' => 'Konyagi (Shot)', 'price' => 2000],
                    ['name' => 'Gordon\'s Gin (Shot)', 'price' => 4000],
                ],
                'Food' => [
                    ['name' => 'Mishkaki with Chips', 'price' => 8000],
                    ['name' => 'Chicken Winds (6pcs)', 'price' => 12000],
                    ['name' => 'Beef Burger', 'price' => 10000],
                    ['name' => 'Loaded Fries', 'price' => 6000],
                ],
                default => []
            };

            foreach ($products as $prod) {
                Product::create([
                    'category_id' => $category->id,
                    'name' => $prod['name'],
                    'price' => $prod['price'],
                    'stock' => 100,
                    'tenant_id' => $tenantId
                ]);
            }
        }
    }
}
