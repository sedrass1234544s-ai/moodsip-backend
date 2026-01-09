<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\StoreMoodRequest;
use App\Http\Resources\Api\MoodResource;
use App\Models\Mood;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class MoodController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $moods = Mood::with(['questions', 'suggestions'])
            ->paginate($request->get('per_page', 15));

        return $this->successResponse(MoodResource::collection($moods));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreMoodRequest $request)
    {
        $data = $request->validated();

        if ($request->hasFile('icon')) {
            $data['icon'] = $request->file('icon')->store('', 'public');
        }

        $mood = Mood::create($data);

        return $this->successResponse(
            new MoodResource($mood->load(['questions', 'suggestions'])),
            __('messages.created'),
            201
        );
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $mood = Mood::with(['questions', 'suggestions'])->find($id);

        if (! $mood) {
            return $this->notFoundResponse();
        }

        return $this->successResponse(new MoodResource($mood));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(StoreMoodRequest $request, string $id)
    {
        $mood = Mood::find($id);

        if (! $mood) {
            return $this->notFoundResponse();
        }

        $data = $request->validated();

        if ($request->hasFile('icon')) {
            // Delete old image if exists
            if ($mood->icon) {
                Storage::disk('public')->delete($mood->icon);
            }

            // Store new image
            $data['icon'] = $request->file('icon')->store('', 'public');
        }

        $mood->update($data);

        return $this->successResponse(
            new MoodResource($mood->load(['questions', 'suggestions'])),
            __('messages.updated')
        );
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $mood = Mood::find($id);

        if (! $mood) {
            return $this->notFoundResponse();
        }

        $mood->delete();

        return $this->successResponse(null, __('messages.deleted'));
    }
}
