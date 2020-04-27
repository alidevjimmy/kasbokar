<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Jenssegers\Mongodb\Eloquent\SoftDeletes;
use Iatstuti\Database\Support\CascadeSoftDeletes;

class Answer extends Model
{
    use SoftDeletes , CascadeSoftDeletes;
    protected $connection = 'pgsql';
    protected $table = 'answers';
    protected $fillable = ['user_id' , 'content_id' , 'answer' , 'accepted'];

    protected $cascadeDeletes = ['replays'];
    protected $dates = ['deleted_at'];

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
