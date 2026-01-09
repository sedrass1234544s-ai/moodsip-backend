<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Facades\Storage;

class Suggestion extends Model
{
    use HasFactory;

    protected $fillable = [
        'book_id',
        'coffe_id',
        'activity_id',
        'icon',
        'mood_id',
    ];

    /**
     * Get the book that owns the suggestion.
     */
    public function book(): BelongsTo
    {
        return $this->belongsTo(Book::class);
    }

    /**
     * Get the coffee that owns the suggestion.
     */
    public function coffee(): BelongsTo
    {
        return $this->belongsTo(Coffee::class, 'coffe_id');
    }

    /**
     * Get the activity that owns the suggestion.
     */
    public function activity(): BelongsTo
    {
        return $this->belongsTo(Activity::class);
    }

    /**
     * Get the mood that owns the suggestion.
     */
    public function mood(): BelongsTo
    {
        return $this->belongsTo(Mood::class);
    }

    /**
     * Get the user suggestions for the suggestion.
     */
    public function userSuggestions(): HasMany
    {
        return $this->hasMany(UserSuggestion::class);
    }

    public function getIconAttribute(): ?string
    {
        $icon = $this->attributes['icon'] ?? null;

        if (! $icon) {
            return null;
        }

        return Storage::disk('public')->url($icon);
    }
}
