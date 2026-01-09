<?php

namespace Database\Seeders;

use App\Models\Question;
use Illuminate\Database\Seeder;

class QuestionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $questions = [
            [
                'question_ar' => 'كيف تشعر الآن؟',
                'question_en' => 'How do you feel right now?',
            ],
            [
                'question_ar' => 'ما هو مستوى طاقتك اليوم؟',
                'question_en' => 'What is your energy level today?',
            ],
            [
                'question_ar' => 'كيف كان نومك الليلة الماضية؟',
                'question_en' => 'How was your sleep last night?',
            ],
            [
                'question_ar' => 'ما هو شعورك تجاه اليوم؟',
                'question_en' => 'How do you feel about today?',
            ],
            [
                'question_ar' => 'كيف تشعر جسدياً الآن؟',
                'question_en' => 'How does your body feel right now?',
            ],
            [
                'question_ar' => 'ما هو مستوى توترك؟',
                'question_en' => 'What is your stress level?',
            ],
            [
                'question_ar' => 'كيف تشعر عاطفياً؟',
                'question_en' => 'How do you feel emotionally?',
            ],
            [
                'question_ar' => 'ما هو مزاجك العام؟',
                'question_en' => 'What is your general mood?',
            ],
            [
                'question_ar' => 'كيف تشعر تجاه نفسك؟',
                'question_en' => 'How do you feel about yourself?',
            ],
            [
                'question_ar' => 'ما هو مستوى راحتك؟',
                'question_en' => 'What is your comfort level?',
            ],
        ];

        foreach ($questions as $question) {
            Question::create($question);
        }
    }
}
