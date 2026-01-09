<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Facades\Storage;

class Coffee extends Model
{
    use HasFactory;

    protected $fillable = [
        'name_ar',
        'name_en',
        'image',
    ];

    /**
     * Get the coffee palaces for the coffee.
     */
    public function coffeePalaces(): HasMany
    {
        return $this->hasMany(CoffeePalace::class);
    }

    /**
     * Get the suggestions for the coffee.
     */
    public function suggestions(): HasMany
    {
        return $this->hasMany(Suggestion::class, 'coffe_id');
    }

    public function getImageAttribute(): ?string
    {
        $image = $this->attributes['image'] ?? null;

        if (! $image) {
            return null;
        }

        return Storage::disk('public')->url($image);
    }
}
