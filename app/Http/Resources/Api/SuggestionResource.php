<?php

namespace App\Http\Resources\Api;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class SuggestionResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'book' => new BookResource($this->whenLoaded('book')),
            'coffee' => new CoffeeResource($this->whenLoaded('coffee')),
            'activity' => new ActivityResource($this->whenLoaded('activity')),
            'mood' => new MoodResource($this->whenLoaded('mood')),
            'mood_id' => $this->mood_id,
            'icon' => $this->icon,
            'coffee_palaces' => CoffeePalaceResource::collection($this->whenLoaded('coffee.coffeePalaces')),
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ];
    }
}
