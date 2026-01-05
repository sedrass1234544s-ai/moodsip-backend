<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class UserSuggestion extends Model
{
    use HasFactory;

    protected $fillable = [
        'suggestion_id',
        'user_id',
    ];

    /**
     * Get the suggestion that owns the user suggestion.
     */
    public function suggestion(): BelongsTo
    {
        return $this->belongsTo(Suggestion::class);
    }

    /**
     * Get the user that owns the user suggestion.
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
