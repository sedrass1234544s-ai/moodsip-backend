<?php

namespace Database\Seeders;

use App\Models\Activity;
use Illuminate\Database\Seeder;

class ActivitySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $activities = [
            [
                'name_ar' => 'قراءة كتاب',
                'name_en' => 'Reading a Book',
                'icon' => 'activities/icons/reading.png',
            ],
            [
                'name_ar' => 'المشي في الطبيعة',
                'name_en' => 'Walking in Nature',
                'icon' => 'activities/icons/walking.png',
            ],
            [
                'name_ar' => 'الاستماع للموسيقى',
                'name_en' => 'Listening to Music',
                'icon' => 'activities/icons/music.png',
            ],
            [
                'name_ar' => 'التأمل',
                'name_en' => 'Meditation',
                'icon' => 'activities/icons/meditation.png',
            ],
            [
                'name_ar' => 'ممارسة الرياضة',
                'name_en' => 'Exercise',
                'icon' => 'activities/icons/exercise.png',
            ],
            [
                'name_ar' => 'كتابة اليوميات',
                'name_en' => 'Journaling',
                'icon' => 'activities/icons/journaling.png',
            ],
            [
                'name_ar' => 'الرسم',
                'name_en' => 'Drawing',
                'icon' => 'activities/icons/drawing.png',
            ],
            [
                'name_ar' => 'الطبخ',
                'name_en' => 'Cooking',
                'icon' => 'activities/icons/cooking.png',
            ],
        ];

        foreach ($activities as $activity) {
            Activity::create($activity);
        }
    }
}
