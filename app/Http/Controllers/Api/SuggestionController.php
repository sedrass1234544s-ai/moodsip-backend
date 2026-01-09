<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\StoreSuggestionRequest;
use App\Http\Resources\Api\SuggestionResource;
use App\Models\Suggestion;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class SuggestionController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $query = Suggestion::with(['book', 'coffee.coffeePalaces', 'activity', 'mood']);

        if ($request->has('mood_id')) {
            $query->where('mood_id', $request->mood_id);
        }

        $suggestions = $query->paginate($request->get('per_page', 15));

        return $this->successResponse(SuggestionResource::collection($suggestions));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreSuggestionRequest $request)
    {
        $data = $request->validated();

        if ($request->hasFile('icon')) {
            $data['icon'] = $request->file('icon')->store('', 'public');
        }

        $suggestion = Suggestion::create($data);

        return $this->successResponse(
            new SuggestionResource($suggestion->load(['book', 'coffee.coffeePalaces', 'activity', 'mood'])),
            __('messages.created'),
            201
        );
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $suggestion = Suggestion::with(['book', 'coffee.coffeePalaces', 'activity', 'mood'])->find($id);

        if (! $suggestion) {
            return $this->notFoundResponse();
        }

        return $this->successResponse(new SuggestionResource($suggestion));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(StoreSuggestionRequest $request, string $id)
    {
        $suggestion = Suggestion::find($id);

        if (! $suggestion) {
            return $this->notFoundResponse();
        }

        $data = $request->validated();

        if ($request->hasFile('icon')) {
            // Delete old image if exists
            if ($suggestion->icon) {
                Storage::disk('public')->delete($suggestion->icon);
            }

            // Store new image
            $data['icon'] = $request->file('icon')->store('', 'public');
        }

        $suggestion->update($data);

        return $this->successResponse(
            new SuggestionResource($suggestion->load(['book', 'coffee.coffeePalaces', 'activity', 'mood'])),
            __('messages.updated')
        );
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $suggestion = Suggestion::find($id);

        if (! $suggestion) {
            return $this->notFoundResponse();
        }

        $suggestion->delete();

        return $this->successResponse(null, __('messages.deleted'));
    }
}
