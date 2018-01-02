<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Question extends Model
{
    protected $fillable = [
        'test_id',
        'content',
        'number_of_answer',
    ];

    public function answers()
    {
    	return $this->hasMany(Answer::class);
    }

    public function test()
    {
    	return $this->belongsTo(Test::class);
    }
}
