<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Question extends Model
{
    protected $table = 'questions';

    protected $fillable = [
        'text', 'course_id'
    ];

    public function course()
    {
        return $this->belongsTo('App\Course', 'course_id', 'id');
    }

    public function variants()
    {
        return $this->hasMany('App\QuestionVariant', 'question_id', 'id');
    }


}
