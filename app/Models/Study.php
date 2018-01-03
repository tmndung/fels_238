<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Study extends Model
{
    protected $fillable = [
        'user_id',
        'course_id',
        'score',
    ];

    public function course()
    {
        return $this->belongsTo(Course::class);
    }

    public function lessons()
    {
        return $this->belongsToMany(Lesson::class, 'study_lesson', 'study_id', 'lesson_id')->withPivot('is_finish')->withTimestamps();
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
