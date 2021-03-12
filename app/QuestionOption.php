<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class QuestionOption extends Model
{
    protected $fillable = ['option','image','correct','question_id',];

    public function getCorrectTextAttribute(): string
    {
        return $this->attributes['correct'] == 1 ? 'Yes' : 'No';
    }


    public function getImageAttribute($value): string
    {
        return url($value);
    }
}
