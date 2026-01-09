<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\StoreCoffeeRequest;
use App\Http\Resources\Api\CoffeeResource;
use App\Models\Coffee;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class CoffeeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $coffees = Coffee::with('coffeePalaces')
            ->paginate($request->get('per_page', 15));

        return $this->successResponse(CoffeeResource::collection($coffees));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreCoffeeRequest $request)
    {
        $data = $request->validated();

        if ($request->hasFile('image')) {
            $data['image'] = $request->file('image')->store('', 'public');
        }

        $coffee = Coffee::create($data);

        return $this->successResponse(
            new CoffeeResource($coffee->load('coffeePalaces')),
            __('messages.created'),
            201
        );
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $coffee = Coffee::with('coffeePalaces')->find($id);

        if (! $coffee) {
            return $this->notFoundResponse();
        }

        return $this->successResponse(new CoffeeResource($coffee));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(StoreCoffeeRequest $request, string $id)
    {
        $coffee = Coffee::find($id);

        if (! $coffee) {
            return $this->notFoundResponse();
        }

        $data = $request->validated();

        if ($request->hasFile('image')) {
            // Delete old image if exists
            if ($coffee->image) {
                Storage::disk('public')->delete($coffee->image);
            }

            // Store new image
            $data['image'] = $request->file('image')->store('', 'public');
        }

        $coffee->update($data);

        return $this->successResponse(
            new CoffeeResource($coffee->load('coffeePalaces')),
            __('messages.updated')
        );
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $coffee = Coffee::find($id);

        if (! $coffee) {
            return $this->notFoundResponse();
        }

        $coffee->delete();

        return $this->successResponse(null, __('messages.deleted'));
    }
}
