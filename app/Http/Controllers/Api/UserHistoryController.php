<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\Api\AnswerResource;
use App\Http\Resources\Api\SuggestionResource;
use Illuminate\Http\Request;

class UserHistoryController extends Controller
{
    /**
     * Get complete user history with suggestions, answers, and questions.
     */
    public function history(Request $request)
    {
        $user = $request->user();

        // Get all user suggestions with full relationships, ordered by latest first
        $userSuggestions = $user->userSuggestions()
            ->with(['suggestion.book', 'suggestion.coffee.coffeePalaces', 'suggestion.activity', 'suggestion.mood'])
            ->latest()
            ->get();

        // Get all user answers with their questions, ordered by latest first
        $allUserAnswers = $user->userAnswers()
            ->with('answer.question')
            ->latest()
            ->get();

        // Track which answers have been assigned to avoid duplicates
        $usedAnswerIds = [];
        $history = [];

        // Build history array with suggestions and their related answers
        foreach ($userSuggestions as $userSuggestion) {
            $suggestion = $userSuggestion->suggestion;
            $suggestionDate = $userSuggestion->created_at;

            // Get the 4 most recent answers that were created before or at the time of this suggestion
            // and haven't been used for a more recent suggestion
            $relatedUserAnswers = $allUserAnswers
                ->filter(function ($userAnswer) use ($suggestionDate, $usedAnswerIds) {
                    return $userAnswer->created_at <= $suggestionDate
                        && ! in_array($userAnswer->id, $usedAnswerIds);
                })
                ->take(4);

            // Extract answers and mark them as used
            $relatedAnswers = $relatedUserAnswers->map(function ($userAnswer) use (&$usedAnswerIds) {
                $usedAnswerIds[] = $userAnswer->id;

                return $userAnswer->answer;
            });

            $history[] = [
                'suggestion' => new SuggestionResource($suggestion),
                'date' => $suggestionDate,
                'answers' => AnswerResource::collection($relatedAnswers),
            ];
        }

        return $this->successResponse($history);
    }

    /**
     * Get user's answer history.
     */
    public function myAnswers(Request $request)
    {
        $user = $request->user();
        $userAnswers = $user->userAnswers()->with('answer.question')->get();

        return $this->successResponse(AnswerResource::collection($userAnswers->pluck('answer')));
    }

    /**
     * Get user's suggestion history.
     */
    public function mySuggestions(Request $request)
    {
        $user = $request->user();
        $userSuggestions = $user->userSuggestions()
            ->with(['suggestion.book', 'suggestion.coffee.coffeePalaces', 'suggestion.activity', 'suggestion.mood'])
            ->latest()
            ->get();

        return $this->successResponse(
            SuggestionResource::collection($userSuggestions->pluck('suggestion'))
        );
    }

    /**
     * Get user's most recent suggestion.
     */
    public function myCurrentSuggestion(Request $request)
    {
        $user = $request->user();
        $userSuggestion = $user->userSuggestions()
            ->with(['suggestion.book', 'suggestion.coffee.coffeePalaces', 'suggestion.activity', 'suggestion.mood'])
            ->latest()
            ->first();

        if (! $userSuggestion) {
            return $this->notFoundResponse(__('messages.not_found'));
        }

        return $this->successResponse(new SuggestionResource($userSuggestion->suggestion));
    }
}
