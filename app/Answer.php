<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Jenssegers\Mongodb\Eloquent\SoftDeletes;

class Answer extends Model
{
    use SoftDeletes;
    protected $connection = 'pgsql';
    protected $table = 'answers';
    protected $fillable = ['user_id' , 'content_id' , 'answer' , 'replay' , 'accepted'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
