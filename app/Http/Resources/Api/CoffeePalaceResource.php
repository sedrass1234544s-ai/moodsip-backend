<?php

namespace App\Http\Resources\Api;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class CoffeePalaceResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        $locale = app()->getLocale();
        $nameField = $locale === 'ar' ? 'name_ar' : 'name_en';

        return [
            'id' => $this->id,
            'name' => $this->$nameField,
            'name_ar' => $this->name_ar,
            'name_en' => $this->name_en,
            'location_link' => $this->location_link,
            'coffee_id' => $this->coffee_id,
            'coffee' => new CoffeeResource($this->whenLoaded('coffee')),
            'image' => $this->image,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ];
    }
}
