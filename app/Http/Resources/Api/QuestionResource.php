<?php

namespace App\Http\Resources\Api;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class QuestionResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        $locale = app()->getLocale();
        $questionField = $locale === 'ar' ? 'question_ar' : 'question_en';

        return [
            'id' => $this->id,
            'question' => $this->$questionField,
            'question_ar' => $this->question_ar,
            'question_en' => $this->question_en,
            'answers' => AnswerResource::collection($this->whenLoaded('answers')),
            'moods' => MoodResource::collection($this->whenLoaded('moods')),
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ];
    }
}
