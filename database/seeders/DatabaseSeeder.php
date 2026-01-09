<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call([
            AdminUserSeeder::class,
            MoodSeeder::class,
            QuestionSeeder::class,
            AnswerSeeder::class,
            QuestionMoodSeeder::class,
            CoffeeSeeder::class,
            ActivitySeeder::class,
            BookSeeder::class,
            CoffeePalaceSeeder::class,
            SuggestionSeeder::class,
        ]);
    }
}
