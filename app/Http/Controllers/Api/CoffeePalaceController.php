<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\StoreCoffeePalaceRequest;
use App\Http\Resources\Api\CoffeePalaceResource;
use App\Models\CoffeePalace;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class CoffeePalaceController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $query = CoffeePalace::with('coffee');

        if ($request->has('coffee_id')) {
            $query->where('coffee_id', $request->coffee_id);
        }

        $coffeePalaces = $query->paginate($request->get('per_page', 15));

        return $this->successResponse(CoffeePalaceResource::collection($coffeePalaces));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreCoffeePalaceRequest $request)
    {
        $data = $request->validated();

        if ($request->hasFile('image')) {
            $data['image'] = $request->file('image')->store('', 'public');
        }

        $coffeePalace = CoffeePalace::create($data);

        return $this->successResponse(
            new CoffeePalaceResource($coffeePalace->load('coffee')),
            __('messages.created'),
            201
        );
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $coffeePalace = CoffeePalace::with('coffee')->find($id);

        if (! $coffeePalace) {
            return $this->notFoundResponse();
        }

        return $this->successResponse(new CoffeePalaceResource($coffeePalace));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(StoreCoffeePalaceRequest $request, string $id)
    {
        $coffeePalace = CoffeePalace::find($id);

        if (! $coffeePalace) {
            return $this->notFoundResponse();
        }

        $data = $request->validated();

        if ($request->hasFile('image')) {
            // Delete old image if exists
            if ($coffeePalace->image) {
                Storage::disk('public')->delete($coffeePalace->image);
            }

            // Store new image
            $data['image'] = $request->file('image')->store('', 'public');
        }

        $coffeePalace->update($data);

        return $this->successResponse(
            new CoffeePalaceResource($coffeePalace->load('coffee')),
            __('messages.updated')
        );
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $coffeePalace = CoffeePalace::find($id);

        if (! $coffeePalace) {
            return $this->notFoundResponse();
        }

        $coffeePalace->delete();

        return $this->successResponse(null, __('messages.deleted'));
    }
}
