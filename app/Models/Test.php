<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Test extends Model
{
    protected $fillable = [
        'lesson_id',
        'time',
        'point_need_pass',
    ];

    public function questions()
    {
    	return $this->hasMany(Question::class);
    }

    public function lesson()
    {
    	return $this->belongsTo(Lesson::class);
    }
}
