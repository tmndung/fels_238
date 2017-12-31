<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class WordList extends Model
{
    protected $table = 'word_lists';

    protected $fillable = [
        'lesson_id',
        'name',
        'pronunciation',
        'explain',
    ];

    public function lesson()
    {
    	return $this->belongsTo(Lesson::class);
    }
}
