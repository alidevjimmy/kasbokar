<?php

namespace App;

use Iatstuti\Database\Support\CascadeSoftDeletes;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use Notifiable;
    use SoftDeletes , CascadeSoftDeletes;
    protected $connection = 'pgsql';
    protected $table = 'users';
    protected $cascadeDeletes = ['favs' , 'experiences' , 'contents' , 'answers' , 'comments' , 'suggests'];
    protected $dates = ['deleted_at'];
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'fullName', 'email', 'password','phone' , 'level' , 'isAdmin' , 'workStatus' , 'active' , 'username' , 'about' , 'avatar'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function answers()
    {
        return $this->hasMany(Answer::class);
    }
    public function contents()
    {
        return $this->belongsToMany(Content::class);
    }

    public function scopeIsActive($query)
    {
        return $query->where('active' , true);
    }

    public function experiences()
    {
        return $this->hasMany(Expriece::class);
    }

    public function favs()
    {
        return $this->hasMany(Fav::class);
    }

    public function comments()
    {
        return $this->hasMany(Comment::class);
    }

    public function suggests()
    {
        return $this->hasMany(Suggest::class);
    }
}
