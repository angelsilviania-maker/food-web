<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Foods;

class FoodSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $foods = [
            [
                'name' => 'Nasi Goreng Spesial',
                'category' => 'makanan',
                'price' => 20000,
                'description' => 'Nasi goreng dengan telor dan ayam suwir',
                'image' => null,
            ],
        ];

        foreach ($foods as $food) {
            Foods::create($food);
        }
    }
}