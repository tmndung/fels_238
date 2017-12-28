<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Course extends Model
{
    protected $fillable = [
        'category_id',
        'name',
        'infomation',
        'rank',
        'picture',
        'number_of_lesson',
    ];

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function lessons()
    {
        return $this->hasMany(Lesson::class);
    }

    public function studies()
    {
        return $this->hasMany(Study::class);
    }
}
