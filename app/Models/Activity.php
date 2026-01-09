<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Facades\Storage;

class Activity extends Model
{
    use HasFactory;

    protected $fillable = [
        'name_ar',
        'name_en',
        'icon',
    ];

    /**
     * Get the suggestions for the activity.
     */
    public function suggestions(): HasMany
    {
        return $this->hasMany(Suggestion::class);
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
