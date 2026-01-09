<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\StoreAnswerRequest;
use App\Http\Resources\Api\AnswerResource;
use App\Models\Answer;
use Illuminate\Http\Request;

class AnswerController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $query = Answer::with('question');

        if ($request->has('question_id')) {
            $query->where('question_id', $request->question_id);
        }

        $answers = $query->paginate($request->get('per_page', 15));

        return $this->successResponse(AnswerResource::collection($answers));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreAnswerRequest $request)
    {
        $answer = Answer::create($request->validated());

        return $this->successResponse(
            new AnswerResource($answer->load('question')),
            __('messages.created'),
            201
        );
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $answer = Answer::with('question')->find($id);

        if (! $answer) {
            return $this->notFoundResponse();
        }

        return $this->successResponse(new AnswerResource($answer));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(StoreAnswerRequest $request, string $id)
    {
        $answer = Answer::find($id);

        if (! $answer) {
            return $this->notFoundResponse();
        }

        $answer->update($request->validated());

        return $this->successResponse(
            new AnswerResource($answer->load('question')),
            __('messages.updated')
        );
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $answer = Answer::find($id);

        if (! $answer) {
            return $this->notFoundResponse();
        }

        $answer->delete();

        return $this->successResponse(null, __('messages.deleted'));
    }
}
