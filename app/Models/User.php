<?php

namespace App\Models;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Hash;
use File;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'description',
        'facebook',
        'twitter',
        'avatar',
        'background',
        'is_admin',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 
        'remember_token',
    ];

    protected $appends = [
        'avatar_path',
        'background_path',
    ];

    public function studies()
    {
        return $this->hasMany(Study::class);
    }

    public function follows()
    {
        return $this->hasMany(Follow::class);
    }

    public function setPasswordAttribute($value)
    {
        return $this->attributes['password'] = Hash::make($value);
    }

    public function getAvatarPathAttribute()
    {
        $pathFile = config('setting.folderUpload') . $this->attributes['avatar'];
        if (!File::exists(public_path($pathFile)) || empty($this->attributes['avatar'])) {

            return config('setting.userAvatarDefault');
        }

        return config('setting.pathUpload') . $this->attributes['avatar']; 
    }

    public function getBackgroundPathAttribute()
    {
        $pathFile = config('setting.folderUpload') . $this->attributes['background'];
        if (!File::exists(public_path($pathFile)) || empty($this->attributes['background'])) {

            return config('setting.userBackgroundDefault');
        }

        return config('setting.pathUpload') . $this->attributes['background']; 
    }
}
