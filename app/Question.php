<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Question extends Model
{
    protected $fillable = ['question','answer_type','description', 'point','image','quiz_id','visible',];

    public function options(): \Illuminate\Database\Eloquent\Relations\HasMany
    {
        return $this->hasMany(QuestionOption::class, 'question_id');
    }

    public function quiz(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(Quiz::class, 'quiz_id');
    }

    public function getAnswerTypeTextAttribute(): string
    {
        switch ($this->attributes['answer_type']){
            case 1:
                return 'Single Selection';
            case 2:
                return 'Multiple Selection';
            case 3:
                return 'Text Answer';
        }
    }

    public function getVisibleTextAttribute(): string
    {
        return $this->attributes['visible'] == 1 ? 'Yes' : 'No';
    }

    public function scopeVisible($query)
    {
        return $query->where('visible', 1);
    }

    public function getImageUrlAttribute(): string
    {
        return !is_null($this->attributes['image']) ? url($this->attributes['image']) : false;
    }
}
