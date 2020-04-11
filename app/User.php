<?php

namespace App;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Jenssegers\Mongodb\Eloquent\HybridRelations;

class User extends Authenticatable
{
    use Notifiable;
    use SoftDeletes;
    use HybridRelations;
    protected $connection = 'pgsql';
    protected $table = 'users';
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'fullName', 'email', 'password','phone' , 'level' , 'isAdmin' , 'workStatus' , 'active'
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
        return $this->belongsToMany(Content::class , 'user_content' , 'user_id' , 'content_id');
    }

    public function scopeIsActive($query)
    {
        return $query->where('active' , true);
    }
}
