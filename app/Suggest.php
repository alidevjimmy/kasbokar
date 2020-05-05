<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Suggest extends Model
{
    use SoftDeletes;
    protected $fillable = ['user_id' , 'content_id' , 'description'];
    protected $table = 'suggests';
    protected $connection = 'pgsql';
    protected $dates = ['deleted_at'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
