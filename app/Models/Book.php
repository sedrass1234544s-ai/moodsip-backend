<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

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
}
