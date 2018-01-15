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

    public function scopeWordlistOfLesson($query, $idLessons)
    {
        return is_array($idLessons) ? $query->whereIn('lesson_id', $idLessons) : $query->where('lesson_id', $idLessons);
    }
}
