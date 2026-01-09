<?php

namespace Database\Seeders;

use App\Models\Answer;
use App\Models\Question;
use Illuminate\Database\Seeder;

class AnswerSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $questions = Question::all();

        foreach ($questions as $question) {
            // Create 3-4 answers for each question
            $answers = [
                [
                    'question_id' => $question->id,
                    'answer_ar' => 'ممتاز',
                    'answer_en' => 'Excellent',
                ],
                [
                    'question_id' => $question->id,
                    'answer_ar' => 'جيد',
                    'answer_en' => 'Good',
                ],
                [
                    'question_id' => $question->id,
                    'answer_ar' => 'متوسط',
                    'answer_en' => 'Average',
                ],
                [
                    'question_id' => $question->id,
                    'answer_ar' => 'سيء',
                    'answer_en' => 'Poor',
                ],
            ];

            foreach ($answers as $answer) {
                Answer::create($answer);
            }
        }
    }
}
