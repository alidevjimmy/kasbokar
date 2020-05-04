<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Jenssegers\Mongodb\Eloquent\SoftDeletes;

class Comment extends Model
{
    use SoftDeletes;
    protected $connection = 'pgsql';
    protected $table = 'comments';
    protected $fillable = ['user_id' , 'body' , 'commentable_id' , 'commentable_type' , 'parent_id'];
    protected $dates = ['deleted_at'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function commentable()
    {
        return $this->morphTo();
    }

}
