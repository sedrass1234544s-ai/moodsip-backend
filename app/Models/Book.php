<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Facades\Storage;

class Book extends Model
{
    use HasFactory;

    protected $fillable = [
        'name_en',
        'name_ar',
        'book_link',
        'image',
    ];

    /**
     * Get the suggestions for the book.
     */
    public function suggestions(): HasMany
    {
        return $this->hasMany(Suggestion::class);
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
