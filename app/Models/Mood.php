<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Facades\Storage;

class Mood extends Model
{
    use HasFactory;

    protected $fillable = [
        'name_ar',
        'name_en',
        'icon',
    ];

    /**
     * Get the suggestions for the mood.
     */
    public function suggestions(): HasMany
    {
        return $this->hasMany(Suggestion::class);
    }

    /**
     * Get the questions for the mood.
     */
    public function questions(): BelongsToMany
    {
        return $this->belongsToMany(Question::class, 'question_moods');
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
