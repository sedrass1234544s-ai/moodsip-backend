<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\SubmitAnswersRequest;
use App\Http\Resources\Api\QuestionResource;
use App\Http\Resources\Api\SuggestionResource;
use App\Models\Question;
use App\Models\UserAnswer;
use App\Services\SuggestionService;
use Illuminate\Http\Request;

class QuizController extends Controller
{
    protected SuggestionService $suggestionService;

    public function __construct(SuggestionService $suggestionService)
    {
        $this->suggestionService = $suggestionService;
    }

    /**
     * Get 4 random questions with answers.
     */
    public function getQuestions(Request $request)
    {
        $questions = Question::with('answers')
            ->inRandomOrder()
            ->take(4)
            ->get();

        return $this->successResponse(QuestionResource::collection($questions));
    }

    /**
     * Submit answers and generate suggestion.
     */
    public function submitAnswers(SubmitAnswersRequest $request)
    {
        $user = $request->user();
        $answers = $request->input('answers');

        // Take only the first 4 answers
        $answers = array_slice($answers, 0, 4);

        // Store user answers
        foreach ($answers as $answerData) {
            UserAnswer::updateOrCreate(
                [
                    'user_id' => $user->id,
                    'answer_id' => $answerData['answer_id'],
                ],
                [
                    'user_id' => $user->id,
                    'answer_id' => $answerData['answer_id'],
                ]
            );
        }

        // Extract answer IDs from the 4 answers
        $answerIds = array_column($answers, 'answer_id');

        // Calculate the most common mood from the 4 answers
        $mood = $this->suggestionService->calculateMoodFromAnswers($answerIds);

        if (! $mood) {
            return $this->errorResponse(__('messages.error'), null, 404);
        }

        // Get a random suggestion for the mood
        $suggestion = $this->suggestionService->getRandomSuggestion($mood->id);

        if (! $suggestion) {
            return $this->errorResponse(__('messages.error'), null, 404);
        }

        // Load all relationships
        $suggestion->load(['book', 'coffee.coffeePalaces', 'activity', 'mood']);

        // Store user suggestion
        $user->userSuggestions()->create([
            'suggestion_id' => $suggestion->id,
        ]);

        return $this->successResponse(
            new SuggestionResource($suggestion),
            __('messages.suggestion_generated')
        );
    }
}
