<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Quiz extends Model
{
    protected $fillable = ['title','course_id', 'min_score','visible', 'negative_point', 'private', 'quiz_hints'];

    public function course(): BelongsTo
    {
        return $this->belongsTo(Course::class, 'course_id');
    }

    public function questions(): HasMany
    {
        return $this->hasMany(Question::class, 'quiz_id');
    }

    public function attempts(): HasMany
    {
        return $this->hasMany(QuizAttempt::class, 'quiz_id');
    }

    public function getTotalPointAttribute(): string
    {
        return $this->questions()->where('visible', 1)->sum('point');
    }

    public function getPrivateTextAttribute(): string
    {
        return $this->attributes['private'] == 1 ? 'Yes' : 'No';
    }

    public function getIsPrivateAttribute(): bool
    {
        return $this->attributes['private'] == 1;
    }

    public function getHasNegativePointAttribute(): bool
    {
        return $this->attributes['negative_point'] == 1;
    }

    public function getNegativePointTextAttribute(): string
    {
        return $this->attributes['negative_point'] == 1 ? 'Yes' : 'No';
    }


    public function getVisibleTextAttribute(): string
    {
        return $this->attributes['visible'] == 1 ? 'Yes' : 'No';
    }

    public function getSlugAttribute(): string
    {
        return preg_replace('/\W+/', '-', strtolower(trim($this->attributes['title'] )));
    }


    public function scopeVisible($query)
    {
        return $query->where('visible', 1);
    }
}
