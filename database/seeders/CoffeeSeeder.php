<?php

namespace Database\Seeders;

use App\Models\Coffee;
use Illuminate\Database\Seeder;

class CoffeeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $coffees = [
            [
                'name_ar' => 'إسبريسو',
                'name_en' => 'Espresso',
                'image' => 'espresso.jpg',
            ],
            [
                'name_ar' => 'كابتشينو',
                'name_en' => 'Cappuccino',
                'image' => 'cappuccino.jpg',
            ],
            [
                'name_ar' => 'لاتيه',
                'name_en' => 'Latte',
                'image' => 'latte.jpg',
            ],
            [
                'name_ar' => 'أمريكانو',
                'name_en' => 'Americano',
                'image' => 'americano.jpg',
            ],
            [
                'name_ar' => 'موكا',
                'name_en' => 'Mocha',
                'image' => 'mocha.jpg',
            ],
            [
                'name_ar' => 'قهوة عربية',
                'name_en' => 'Arabic Coffee',
                'image' => 'arabic-coffee.jpg',
            ],
        ];

        foreach ($coffees as $coffee) {
            Coffee::create($coffee);
        }
    }
}
