<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use File;

class WordList extends Model
{
    protected $table = 'word_lists';

    protected $fillable = [
        'lesson_id',
        'name',
        'pronunciation',
        'explain',
        'file_listen',
    ];

    protected $appends = [
        'file_listen_path',
    ];

    public function lesson()
    {
    	return $this->belongsTo(Lesson::class);
    }

    public function scopeWordlistOfLesson($query, $idLessons)
    {
        return is_array($idLessons) ? $query->whereIn('lesson_id', $idLessons) : $query->where('lesson_id', $idLessons);
    }

    public function getFileListenPathAttribute()
    {
        $pathFile = config('setting.pathUpload') . $this->attributes['file_listen'];
        if (!File::exists(public_path($pathFile)) || empty($this->attributes['file_listen'])) {
            return config('setting.fileListenDefault');
        }

        return config('setting.pathUpload') . $this->attributes['file_listen']; 
    }
}
