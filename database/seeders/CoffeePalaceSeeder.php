<?php

namespace Database\Seeders;

use App\Models\Coffee;
use App\Models\CoffeePalace;
use Illuminate\Database\Seeder;

class CoffeePalaceSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $coffees = Coffee::all();

        foreach ($coffees as $coffee) {
            // Create 2-3 coffee palaces for each coffee type
            $palaces = [
                [
                    'coffee_id' => $coffee->id,
                    'name_ar' => 'مقهى '.$coffee->name_ar.' المركزي',
                    'name_en' => $coffee->name_en.' Central Cafe',
                    'location_link' => 'https://maps.google.com/?q='.urlencode($coffee->name_en.' Cafe'),
                    'image' => 'cafe-'.$coffee->id.'-1.jpg',
                ],
                [
                    'coffee_id' => $coffee->id,
                    'name_ar' => 'مقهى '.$coffee->name_ar.' الفاخر',
                    'name_en' => $coffee->name_en.' Premium Cafe',
                    'location_link' => 'https://maps.google.com/?q='.urlencode($coffee->name_en.' Premium'),
                    'image' => 'cafe-'.$coffee->id.'-2.jpg',
                ],
            ];

            foreach ($palaces as $palace) {
                CoffeePalace::create($palace);
            }
        }
    }
}
