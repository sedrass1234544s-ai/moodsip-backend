<?php

namespace Database\Seeders;

use App\Models\Mood;
use App\Models\Question;
use Illuminate\Database\Seeder;

class QuestionMoodSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $questions = Question::all();
        $moods = Mood::all();

        // Assign each question to 2-3 random moods
        foreach ($questions as $question) {
            $randomMoods = $moods->random(rand(2, 3));
            $question->moods()->attach($randomMoods->pluck('id')->toArray());
        }
    }
}
