<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Support\Facades\Storage;

class CoffeePalace extends Model
{
    use HasFactory;

    protected $fillable = [
        'name_en',
        'name_ar',
        'location_link',
        'coffee_id',
        'image',
    ];

    /**
     * Get the coffee that owns the coffee palace.
     */
    public function coffee(): BelongsTo
    {
        return $this->belongsTo(Coffee::class);
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
