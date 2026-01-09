<?php

namespace App\Http\Resources\Api;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class AnswerResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        $locale = app()->getLocale();
        $answerField = $locale === 'ar' ? 'answer_ar' : 'answer_en';

        return [
            'id' => $this->id,
            'answer' => $this->$answerField,
            'answer_ar' => $this->answer_ar,
            'answer_en' => $this->answer_en,
            'question_id' => $this->question_id,
            'question' => new QuestionResource($this->whenLoaded('question')),
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ];
    }
}
