<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Expriece extends Model
{
    use SoftDeletes;
    protected $fillable = ['title' , 'media' , 'description' , 'user_id' , 'link' , 'show'];
    protected $connection = 'pgsql';
    protected $table = 'exprieces';
    protected $dates = ['deleted_at'];
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function scopeIsShow($q) {
        return $q->where('show' , true);
    }
}
