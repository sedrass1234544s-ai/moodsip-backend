<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\StoreActivityRequest;
use App\Http\Resources\Api\ActivityResource;
use App\Models\Activity;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ActivityController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $activities = Activity::paginate($request->get('per_page', 15));

        return $this->successResponse(ActivityResource::collection($activities));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreActivityRequest $request)
    {
        $data = $request->validated();

        if ($request->hasFile('icon')) {
            $data['icon'] = $request->file('icon')->store('', 'public');
        }

        $activity = Activity::create($data);

        return $this->successResponse(
            new ActivityResource($activity),
            __('messages.created'),
            201
        );
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $activity = Activity::find($id);

        if (! $activity) {
            return $this->notFoundResponse();
        }

        return $this->successResponse(new ActivityResource($activity));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(StoreActivityRequest $request, string $id)
    {
        $activity = Activity::find($id);

        if (! $activity) {
            return $this->notFoundResponse();
        }

        $data = $request->validated();

        if ($request->hasFile('icon')) {
            // Delete old image if exists
            if ($activity->icon) {
                Storage::disk('public')->delete($activity->icon);
            }

            // Store new image
            $data['icon'] = $request->file('icon')->store('', 'public');
        }

        $activity->update($data);

        return $this->successResponse(
            new ActivityResource($activity),
            __('messages.updated')
        );
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $activity = Activity::find($id);

        if (! $activity) {
            return $this->notFoundResponse();
        }

        $activity->delete();

        return $this->successResponse(null, __('messages.deleted'));
    }
}
