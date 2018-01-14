<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Follow extends Model
{
    protected $fillable = [
        'user_id',
        'user_follow_id', 
        'status',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function userFollow()
    {
        return $this->belongsTo(User::class, 'user_follow_id', 'id');
    }
}
