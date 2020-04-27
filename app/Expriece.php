<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Expriece extends Model
{
    use SoftDeletes;
    protected $fillable = ['title' , 'media' , 'description' , 'user_id'];
    protected $connection = 'pgsql';
    protected $table = 'expriences';
    protected $dates = ['deleted_at'];
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
