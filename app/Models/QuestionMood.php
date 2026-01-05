<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class QuestionMood extends Model
{
    use HasFactory;

    protected $fillable = [
        'mood_id',
        'question_id',
    ];

    /**
     * Get the mood that owns the question mood.
     */
    public function mood(): BelongsTo
    {
        return $this->belongsTo(Mood::class);
    }

    /**
     * Get the question that owns the question mood.
     */
    public function question(): BelongsTo
    {
        return $this->belongsTo(Question::class);
    }
}
