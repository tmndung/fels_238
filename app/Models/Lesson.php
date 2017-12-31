<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Lesson extends Model
{
    protected $fillable = [
        'course_id',
        'name',
        'content',
        'point',
        'number_of_word',
    ];

    public function tests()
    {
    	return $this->hasMany(Test::class);
    }

    public function wordLists()
    {
    	return $this->hasMany(WordList::class);
    }

    public function studies()
    {
    	return $this->belongsToMany(Study::class);
    }

    public function course()
    {
    	return $this->belongsTo(Course::class);
    }
}
