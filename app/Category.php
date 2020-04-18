<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Category extends Model
{
    use SoftDeletes;
    protected $fillable = ['image' , 'name' , 'level' , 'body'];
    protected $table = 'categories';
    protected $connection = 'pgsql';

    public function contents()
    {
        return $this->hasMany(Content::class , '_id');
    }
}
