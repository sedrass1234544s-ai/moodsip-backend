<?php

namespace Database\Seeders;

use App\Models\Activity;
use App\Models\Book;
use App\Models\Coffee;
use App\Models\Mood;
use App\Models\Suggestion;
use Illuminate\Database\Seeder;

class SuggestionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $moods = Mood::all();
        $coffees = Coffee::all();
        $activities = Activity::all();
        $books = Book::all();

        foreach ($moods as $mood) {
            // Create 2-3 suggestions for each mood
            for ($i = 0; $i < 3; $i++) {
                Suggestion::create([
                    'mood_id' => $mood->id,
                    'coffe_id' => $coffees->random()->id,
                    'activity_id' => $activities->random()->id,
                    'book_id' => $books->random()->id,
                    'icon' => 'suggestions/icons/suggestion-'.$mood->id.'-'.($i + 1).'.png',
                ]);
            }
        }
    }
}
