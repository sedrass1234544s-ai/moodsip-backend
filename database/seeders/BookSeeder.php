<?php

namespace Database\Seeders;

use App\Models\Book;
use Illuminate\Database\Seeder;

class BookSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $books = [
            [
                'name_ar' => 'قوة التفكير الإيجابي',
                'name_en' => 'The Power of Positive Thinking',
                'book_link' => 'https://example.com/positive-thinking',
                'image' => 'positive-thinking.jpg',
            ],
            [
                'name_ar' => 'العادات السبع للناس الأكثر فعالية',
                'name_en' => 'The 7 Habits of Highly Effective People',
                'book_link' => 'https://example.com/7-habits',
                'image' => '7-habits.jpg',
            ],
            [
                'name_ar' => 'فن اللامبالاة',
                'name_en' => 'The Subtle Art of Not Giving a F*ck',
                'book_link' => 'https://example.com/subtle-art',
                'image' => 'subtle-art.jpg',
            ],
            [
                'name_ar' => 'الذكاء العاطفي',
                'name_en' => 'Emotional Intelligence',
                'book_link' => 'https://example.com/emotional-intelligence',
                'image' => 'emotional-intelligence.jpg',
            ],
            [
                'name_ar' => 'التأمل اليومي',
                'name_en' => 'Daily Meditation',
                'book_link' => 'https://example.com/daily-meditation',
                'image' => 'meditation.jpg',
            ],
            [
                'name_ar' => 'السعادة الحقيقية',
                'name_en' => 'Authentic Happiness',
                'book_link' => 'https://example.com/authentic-happiness',
                'image' => 'happiness.jpg',
            ],
        ];

        foreach ($books as $book) {
            Book::create($book);
        }
    }
}
