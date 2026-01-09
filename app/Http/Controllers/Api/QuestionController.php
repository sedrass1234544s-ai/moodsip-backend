<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\StoreQuestionRequest;
use App\Http\Resources\Api\QuestionResource;
use App\Models\Question;
use Illuminate\Http\Request;

class QuestionController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $questions = Question::with(['answers', 'moods'])
            ->paginate($request->get('per_page', 15));

        return $this->successResponse(QuestionResource::collection($questions));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreQuestionRequest $request)
    {
        $question = Question::create($request->validated());

        return $this->successResponse(
            new QuestionResource($question->load(['answers', 'moods'])),
            __('messages.created'),
            201
        );
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $question = Question::with(['answers', 'moods'])->find($id);

        if (! $question) {
            return $this->notFoundResponse();
        }

        return $this->successResponse(new QuestionResource($question));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(StoreQuestionRequest $request, string $id)
    {
        $question = Question::find($id);

        if (! $question) {
            return $this->notFoundResponse();
        }

        $question->update($request->validated());

        return $this->successResponse(
            new QuestionResource($question->load(['answers', 'moods'])),
            __('messages.updated')
        );
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $question = Question::find($id);

        if (! $question) {
            return $this->notFoundResponse();
        }

        $question->delete();

        return $this->successResponse(null, __('messages.deleted'));
    }
}
