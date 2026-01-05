<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class UserAnswer extends Model
{
    use HasFactory;

    protected $fillable = [
        'answer_id',
        'user_id',
    ];

    /**
     * Get the answer that owns the user answer.
     */
    public function answer(): BelongsTo
    {
        return $this->belongsTo(Answer::class);
    }

    /**
     * Get the user that owns the user answer.
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
