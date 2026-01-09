<?php

namespace Database\Seeders;

use App\Models\Mood;
use Illuminate\Database\Seeder;

class MoodSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $moods = [
            [
                'name_ar' => 'سعيد',
                'name_en' => 'Happy',
                'icon' => 'moods/icons/happy.png',
            ],
            [
                'name_ar' => 'حزين',
                'name_en' => 'Sad',
                'icon' => 'moods/icons/sad.png',
            ],
            [
                'name_ar' => 'غاضب',
                'name_en' => 'Angry',
                'icon' => 'moods/icons/angry.png',
            ],
            [
                'name_ar' => 'قلق',
                'name_en' => 'Anxious',
                'icon' => 'moods/icons/anxious.png',
            ],
            [
                'name_ar' => 'مسترخي',
                'name_en' => 'Relaxed',
                'icon' => 'moods/icons/relaxed.png',
            ],
            [
                'name_ar' => 'متعب',
                'name_en' => 'Tired',
                'icon' => 'moods/icons/tired.png',
            ],
        ];

        foreach ($moods as $mood) {
            Mood::create($mood);
        }
    }
}
