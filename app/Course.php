<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Course extends Model
{
    protected $fillable = ['name', 'description'];

    public function quizzes(){
        return $this->hasMany(Quiz::class, 'course_id');
    }
}
