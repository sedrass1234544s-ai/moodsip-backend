<?php

namespace App\Services;

use App\Models\Answer;
use App\Models\Mood;
use App\Models\Suggestion;
use App\Models\User;
use App\Models\UserAnswer;

class SuggestionService
{
    /**
     * Calculate the most common mood from user answers.
     */
    public function calculateUserMood(int $userId): ?Mood
    {
        $userAnswers = UserAnswer::where('user_id', $userId)
            ->with('answer.question.moods')
            ->get();

        if ($userAnswers->isEmpty()) {
            return null;
        }

        $moodCounts = [];

        foreach ($userAnswers as $userAnswer) {
            $question = $userAnswer->answer->question;
            $moods = $question->moods;

            foreach ($moods as $mood) {
                if (! isset($moodCounts[$mood->id])) {
                    $moodCounts[$mood->id] = 0;
                }
                $moodCounts[$mood->id]++;
            }
        }

        if (empty($moodCounts)) {
            return null;
        }

        // Get the mood with the highest count
        $mostCommonMoodId = array_search(max($moodCounts), $moodCounts);

        return Mood::find($mostCommonMoodId);
    }

    /**
     * Calculate the most common mood from given answer IDs.
     */
    public function calculateMoodFromAnswers(array $answerIds): ?Mood
    {
        $answers = Answer::whereIn('id', $answerIds)
            ->with('question.moods')
            ->get();

        if ($answers->isEmpty()) {
            return null;
        }

        $moodCounts = [];

        foreach ($answers as $answer) {
            $question = $answer->question;
            $moods = $question->moods;

            foreach ($moods as $mood) {
                if (! isset($moodCounts[$mood->id])) {
                    $moodCounts[$mood->id] = 0;
                }
                $moodCounts[$mood->id]++;
            }
        }

        if (empty($moodCounts)) {
            return null;
        }

        // Get the mood with the highest count
        $mostCommonMoodId = array_search(max($moodCounts), $moodCounts);

        return Mood::find($mostCommonMoodId);
    }

    /**
     * Get a random suggestion for a given mood.
     */
    public function getRandomSuggestion(int $moodId): ?Suggestion
    {
        $suggestions = Suggestion::where('mood_id', $moodId)->get();

        if ($suggestions->isEmpty()) {
            return null;
        }

        return $suggestions->random();
    }

    /**
     * Generate a suggestion for a user based on their answers.
     */
    public function generateSuggestion(int $userId): ?Suggestion
    {
        $mood = $this->calculateUserMood($userId);

        if (! $mood) {
            return null;
        }

        return $this->getRandomSuggestion($mood->id);
    }
}
