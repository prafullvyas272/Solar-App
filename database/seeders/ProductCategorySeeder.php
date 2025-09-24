<?php

namespace Database\Seeders;

use App\Models\ProductCategory;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ProductCategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $productCategories = ['Solar Panel', 'Inverter', 'Other'];
        collect($productCategories)->each(fn($name) => ProductCategory::firstOrCreate(['name' => $name]));
    }
}
