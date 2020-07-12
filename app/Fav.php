<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Fav extends Model
{
    use SoftDeletes;

    protected $fillable = ['user_id' , 'description'];
    protected $connection = 'pgsql';
    protected $table = 'favs';
    protected $dates = ['deleted_at'];
    
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
