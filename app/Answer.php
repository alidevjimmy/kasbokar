<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Jenssegers\Mongodb\Eloquent\SoftDeletes;

class Answer extends Model
{
    use SoftDeletes;
    protected $connection = 'pgsql';
    protected $table = 'answers';
    protected $fillable = ['user_id' , 'content_id' , 'answer' , 'accepted'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function replays()
    {
        return $this->hasMany(Replay::class);
    }

    public function content()
    {
        return $this->belongsTo(Content::class);
    }
}
