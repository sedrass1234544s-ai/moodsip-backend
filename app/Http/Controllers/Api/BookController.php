<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\StoreBookRequest;
use App\Http\Resources\Api\BookResource;
use App\Models\Book;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class BookController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $books = Book::paginate($request->get('per_page', 15));

        return $this->successResponse(BookResource::collection($books));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreBookRequest $request)
    {
        $data = $request->validated();

        if ($request->hasFile('image')) {
            $data['image'] = $request->file('image')->store('', 'public');
        }

        $book = Book::create($data);

        return $this->successResponse(
            new BookResource($book),
            __('messages.created'),
            201
        );
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $book = Book::find($id);

        if (! $book) {
            return $this->notFoundResponse();
        }

        return $this->successResponse(new BookResource($book));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(StoreBookRequest $request, string $id)
    {
        $book = Book::find($id);

        if (! $book) {
            return $this->notFoundResponse();
        }

        $data = $request->validated();

        if ($request->hasFile('image')) {
            // Delete old image if exists
            if ($book->image) {
                Storage::disk('public')->delete($book->image);
            }

            // Store new image
            $data['image'] = $request->file('image')->store('', 'public');
        }

        $book->update($data);

        return $this->successResponse(
            new BookResource($book),
            __('messages.updated')
        );
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $book = Book::find($id);

        if (! $book) {
            return $this->notFoundResponse();
        }

        $book->delete();

        return $this->successResponse(null, __('messages.deleted'));
    }
}
