<?php

namespace App\Http\Requests\Api;

use Illuminate\Foundation\Http\FormRequest;

class StoreSuggestionRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'book_id' => ['nullable', 'exists:books,id'],
            'coffe_id' => ['nullable', 'exists:coffees,id'],
            'activity_id' => ['nullable', 'exists:activities,id'],
            'mood_id' => ['required', 'exists:moods,id'],
            'icon' => ['nullable', 'image', 'max:2048'],
        ];
    }
}
