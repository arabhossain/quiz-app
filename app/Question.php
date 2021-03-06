<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Question extends Model
{
    protected $fillable = ['question','answer_type', 'fill_gaps', 'description', 'point','image','quiz_id','visible',];

    private $fillInGapInput = '<input ref="fillGaps" type="text"/>';

    protected $appends = ['fill_gaps_htm', 'fill_gaps_code'];

    public function options(): \Illuminate\Database\Eloquent\Relations\HasMany
    {
        return $this->hasMany(QuestionOption::class, 'question_id');
    }

    public function quiz(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(Quiz::class, 'quiz_id');
    }

    public function getFillGapsHtmAttribute(): string
    {
        return preg_replace('/\{{[^)]+\}}/U', $this->fillInGapInput, $this->attributes['fill_gaps']);
    }

    public function getFillGapsCodeAttribute(): string
    {
        $str = '';
        preg_match_all('/\{{[^)]+\}}/U', $this->attributes['fill_gaps'], $matches);
        $gaps = $matches[0] ?? [];
        foreach ($gaps as $gap){
            $value = substr($gap, 2,strlen($gap)-4);
            $gapCode = "<code>$value</code>";
            $str = str_replace($gap, $gapCode, $this->attributes['fill_gaps']);
        }
        return $str;
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
            case 4:
                return 'Fill In The Gaps';
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
