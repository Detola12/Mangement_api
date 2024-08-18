<?php

namespace Database\Seeders;

use App\Models\Product;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Product::create([
            'name' => 'Dangote Cement',
            'price' => 7500
        ]);
        Product::create([
            'name' => 'Lafarge Cement',
            'price' => 7400
        ]);
        Product::create([
            'name' => 'BUA Cement',
            'price' => 7600
        ]);
    }
}
